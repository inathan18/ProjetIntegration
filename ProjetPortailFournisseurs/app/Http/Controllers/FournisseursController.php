<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FournisseurRequest;
use App\Http\Requests\HistoriqueRequest;
use App\Models\Fournisseur;
use App\Models\Historique;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Auth\Events\Registered;
use App\Events\AccountModified;
use App\Events\AccountCreated;
use App\Events\StatusChanged;

use Illuminate\Support\Facades\Storage;

class FournisseursController extends Controller
{

    /* renvois la page principale pour les Fournisseurs */
    public function index()
    {
        $fournisseurs = Fournisseur::all();

        return view('Fournisseurs.Connexion', compact('fournisseurs'));
    }


    public function accueil()
    {
        $fournisseurs = Fournisseur::all();
        $fournisseur_actuel = auth()->guard('fournisseur')->user();
        $telephone = json_decode($fournisseur_actuel->phone[0], true);
        

            $unspsc = json_decode($fournisseur_actuel->unspsc[0], true);
        

        
        $fichier = $this->IniFichier($fournisseur_actuel);

        return view('Fournisseurs.Accueil', compact('fournisseurs', 'fournisseur_actuel', 'telephone', 'unspsc', 'fichier'));
    }


    /* renvois la page de connexion avec le NEQ pour les Fournisseurs */
    public function connexionNEQ()
    {
        $fournisseurs = Fournisseur::all();

        return view('Fournisseurs.ConnexionNEQ', compact('fournisseurs' /*,'commis', 'responsables', 'administrateurs'*/));
    }


    public function statut()
    {
        $fournisseurs = Fournisseur::all();
        $fournisseur_actuel = auth()->guard('fournisseur')->user();

        return view('Fournisseurs.statut', compact('fournisseurs', 'fournisseur_actuel'));
    }


    /* renvois le formulaire de création de compte Fournisseur */
    public function create()
    {
        return view('Fournisseurs.Creation');
    }

    public function createRBQ()
    {
        return view('Fournisseurs.CreationRBQ');
    }

    public function unspsc(){
        return view('Fournisseurs.UNSPSC');
    }


    /* Fonction utilisé pour connecter le Fournisseur a son compte */
    public function login(Request $request)
    {
        $reussi = (auth()->guard('fournisseur')->attempt(['email' => $request->email, 'password' => $request->password]));
        Log::debug('Réussi: ' . $reussi);

        if ($reussi) {
            $fournisseur = Fournisseur::Where('email', $request->email)->firstOrFail();
            return redirect()->route('Fournisseurs.accueil')->with('message', "Connexion réussi");
        } else {
            return redirect()->route('Fournisseurs.connexion')->withErrors(['Informations invalides']);
        }
    }

    /* fonction utilisé pour la création de compte Fournisseur*/
    public function store(Request $request)
    {
        try {
            session()->put($request->all());
            $fournisseur = new Fournisseur($request->all());
            Log::debug($fournisseur);

            $fournisseur['postCode'] = trim($request['postCode']);

            Log::debug(trim($request['postCode']));

            $fournisseur['personneContact'] = "ah";
            $fournisseur['unspsc'] = [$request['unspsc']];

            $fournisseur['region'] = $request['region'];
            $fournisseur['statut'] = "AT";

            $fournisseur->save();
            event(new Registered($fournisseur));
            event(new AccountCreated($fournisseur));
            Auth::guard('fournisseur')->login($fournisseur);
            return redirect()->route('verification.notice')->with('success', 'Nous vous avons envoyé un courriel de vérification. Veuillez cliquer sur le lien reçu par courriel pour confirmer.');
        } catch (\Throwable $e) {
            Log::debug($e);
            return redirect()->route('Fournisseurs.creation');
        }
        return redirect()->route('Fournisseurs.connexion');
    }


    // Fournisseurs selectionnés sur la page de recherche
    public function showSelected(Request $request)
    {
        $selectedIds = $request->session()->get('selected_fournisseurs', []);
        $fournisseurs = Fournisseur::whereIn('id', $selectedIds)->get();
        
        return view('GestionFournisseurs.Selectionnes', [
            'fournisseurs' => $fournisseurs
        ]);
    }

    public function showFiche($id)
    {
        // Récupérer le fournisseur associé à cet ID
        $fournisseur = Fournisseur::findOrFail($id);
    
        // Vérification que les données 'unspsc' et 'typesRbq' ne sont pas nulles et sont des tableaux
        $codesUnspsc = is_string($fournisseur->unspsc) ? json_decode($fournisseur->unspsc, true) : ($fournisseur->unspsc ?? []);
        $codesRbq = is_string($fournisseur->typesRbq) ? json_decode($fournisseur->typesRbq, true) : ($fournisseur->typesRbq ?? []);
    
        // Charger les données du fichier unspsc.json et typesrbq.json depuis le répertoire public
        $unspscFilePath = public_path('unspsc.json');
        $rbqFilePath = public_path('typesrbq.json');
        
        // Vérifier si les fichiers existent
        if (!file_exists($unspscFilePath)) {
            throw new \Exception('Le fichier UNSPSC n\'existe pas.');
        }
        if (!file_exists($rbqFilePath)) {
            throw new \Exception('Le fichier RBQ n\'existe pas.');
        }
    
        $unspscData = json_decode(file_get_contents($unspscFilePath), true);
        $rbqData = json_decode(file_get_contents($rbqFilePath), true);
    
        // Vérification de la validité des données chargées
        if (!is_array($unspscData)) {
            throw new \Exception('Le fichier UNSPSC contient des données invalides.');
        }
        if (!is_array($rbqData)) {
            throw new \Exception('Le fichier RBQ contient des données invalides.');
        }
    
        // Produits et services
        $produitsServices = [];
        if (!empty($codesUnspsc)) {
            foreach ($codesUnspsc as $code) {
                foreach ($unspscData as $item) {
                    if ($item['codeUnspsc'] == $code) {
                        $produitsServices[] = $item['codeUnspsc'] . ' - ' . $item['descUnspsc'];
                    }
                }
            }
        }
    
        // Licences RBQ
        $licencesRbq = [];
        if (!empty($codesRbq)) {
            foreach ($codesRbq as $code) {
                foreach ($rbqData as $item) {
                    if ($item['codeRbq'] == $code) {
                        $licencesRbq[] = $item['codeRbq'] . ' - ' . $item['nomRbq'];
                    }
                }
            }
        }
    
        // Retourner la vue avec les données
        return view('GestionFournisseurs.FicheFournisseur', [
            'fournisseur' => $fournisseur,
            'produitsServices' => $produitsServices,
            'licencesRbq' => $licencesRbq,
        ]);
    }

    public function showHistorique($id)
    {
        $fournisseur = Fournisseur::findOrFail($id);
    
        $historique = Historique::where('fournisseur_id', $id)
            ->orderBy('created_at', 'asc')
            ->get()
            ->map(function ($item) {
                $item->raisonRefus = $item->raisonRefus; 
                return $item;
            });
    
        return view('GestionFournisseurs.historique', [
            'fournisseur' => $fournisseur,
            'historique' => $historique,
        ]);
    }
    
    public function editFiche($id)
    {
        $fournisseur = Fournisseur::findOrFail($id);
        
        return view('GestionFournisseurs.editFiche', compact('fournisseur'));
    }


    public function modifierFournisseur(Request $request, $id)
{
    $fournisseur = Fournisseur::findOrFail($id);

    
    // Validation des données
    $request->validate([
        'name' => 'required|string|max:100',
        'email' => 'required|string|max:100',
        'statut' => 'required|string|max:10',
        'neq' => 'nullable|string',
        'raison' => $request->input('statut') === 'R' ? 'required|string' : 'nullable|string',
        'address' => 'nullable|string|max:100',
        'city' => 'nullable|string|max:100',
        'website' => 'nullable|string|max:255',
    ]);

    // Mise à jour des informations
    $fournisseur->name = $request->input('name');
    $fournisseur->email = $request->input('email');
    $fournisseur->statut = $request->input('statut');
    
    // Si l'état est refusé, stocker la raison du refus
    if ($fournisseur->statut == 'R') {
        $fournisseur->raisonRefus = $request->input('raison');
    } else {
        $fournisseur->raisonRefus = null;
    }

    // Mise à jour des champs
    $fournisseur->neq = $request->input('neq');
    $fournisseur->address = $request->input('address');
    $fournisseur->city = $request->input('city');
    $fournisseur->website = $request->input('website');

    
    if($fournisseur->isDirty('statut')){
        event(new StatusChanged($fournisseur) );
    }
    else if($fournisseur->isDirty()){
        event(new AccountModified($fournisseur));
    }
    $fournisseur->save();
    return redirect()->route('fournisseurs.showFiche', ['id' => $fournisseur->id])
                     ->with('success', 'Les informations ont été modifiées avec succès');
}

    

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $fournisseur_actuel = auth()->guard('fournisseur')->user();

        $telephone = json_decode($fournisseur_actuel->phone[0], true);

        $unspsc = json_decode($fournisseur_actuel->unspsc[0], true);

        $fichier = $this->IniFichier($fournisseur_actuel);

        return view('Fournisseurs.MonDossier', compact('fournisseur_actuel', 'telephone', 'unspsc', 'fichier'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $fournisseur_actuel = auth()->guard('fournisseur')->user();

        $telephone = json_decode($fournisseur_actuel->phone[0], true);

        $unspsc = json_decode($fournisseur_actuel->unspsc[0], true);


        return view('Fournisseurs.Modification', compact('fournisseur_actuel', 'telephone', 'unspsc'));
    }

    public function fichierDelete()
    {
        $fournisseur_actuel = auth()->guard('fournisseur')->user();

        $telephone = json_decode($fournisseur_actuel->phone[0], true);

        $unspsc = json_decode($fournisseur_actuel->unspsc[0], true);

        $fichier = $this->IniFichier($fournisseur_actuel);

        $this->DelFichier($fournisseur_actuel);

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fournisseur $fournisseur)
    {
        try
        {
            $oldData = $fournisseur->only(['personneContact', 'website']);
            $fournisseur->update([
                'personneContact' => $request->personneContact,
                'website' => $request->website,

            ]);
            $changes = array_diff($fournisseur->only(['personneContact', 'website']), $oldData);
            if(!empty($changes)){
                event(new AccountModified($fournisseur));
            }
            return redirect()->route('fournisseur.accueil')->with('message', "Modification de " . $fournisseur->name . " réussi!");
        } catch (\Throwable $e) {
            Log::debug($e);
            return redirect()->route('Fournisseurs.dossier')->withErrors(["la modification n'a pas fonctionné"]);
        }
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return redirect()->route('Fournisseurs.connexion');
    }  

    public function upload(Request $request)
    {

        $fournisseur_actuel = auth()->guard('fournisseur')->user();

        $this->DelFichier($fournisseur_actuel);

        if ($request->hasfile('file')) {
            $fileJSON = array();
            $i = 0;
            foreach ($request->file('file') as $file) {

                Log::debug($file->extension());

                $extension = "." . $file->extension();

                $filename = pathinfo($file, PATHINFO_FILENAME);
                $destinationPath = "fournisseur";
                Storage::disk()->putfileas($destinationPath, $file, $filename . $extension);
                $fileJSON[$i] = $filename . $extension;
                $i++;
            }
            $fournisseur_actuel->update([
                'files' => $fileJSON,

            ]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    }

    //--------------------------------Fonction pour alèger le code-------------------------------------------------

    public function IniFichier($fournisseur)
    {
        try {


            $ctr = count($fournisseur->files);

            $fichier = "";

            for ($i = 0; $i < $ctr; $i++) {
                $fichier .= $fournisseur->files[$i] . " | ";
            }

            if ($fichier == "" || $fichier == " | ") {
                $fichier = "Aucun Fichier Envoyé";
            }
        } catch (\Throwable $e) {
            $fichier = "Aucun Fichier Envoyé";
        }
        return $fichier;
        echo $fichier;
    }

    public function verify(Request $request, $id, $hash){
        $fournisseur = Fournisseur::findOrFail($id);
        if (!hash_equals(sha1($fournisseur->getEmailForVerification()), $hash)){
            return redirect()->route('Fournisseur.connexion')->with('fail', 'Lien de vérification invalide.');
        }
        if ($request->fournisseur()->hasVerifiedEmail()){
            return redirect()->route('Fournisseur.connexion')->with('status', 'Courriel déjà vérifié.');
        }
        if ($request->fournisseur()->markEmailAsVerified()){
            event(new Verified($fournisseur));
        }
        return redirect()->route('Fournisseurs.connexion')->with('verified', true);
    }

    public function check(Request $request){
        $request->validate(['email' => 'required|email',
        'password' => 'required']);

        $fournisseurInfo = Fournisseur::where('email', $request->email)->first();

        if (!$fournisseurInfo){
            return back()->withInput()->withErrors(['email' => 'Courriel n\'existe pas']);
        }

        if($fournisseurInfo->hasVerifiedEmail()){
            return back()->withInput()->withErrors(['email'=>'Vous devez valider votre courriel pour vous connecter.'])
            ->with('resend_email', true);

            session([
                'LoggedFournisseurInfo' => $fournisseurInfo->id,
                'LoggedFournisseurName' => $fournisseurInfo->name,
            ]);
            return redirect()->route('Fournisseur.accueil');
        }
    }



    public function DelFichier($fournisseur)
    {
        try {
            $ctr = count($fournisseur->files);

            for ($i = 0; $i < $ctr; $i++) {
                $filename = $fournisseur->files[$i];

                unlink(storage_path('app/fournisseur/' . $filename));
                Storage::delete($filename);
            }

            $fournisseur->update([
                'files' => [""],
            ]);
        } catch (\Throwable $e) {
        }
    }

    //--------------------------------Fonction pour alèger le code-------------------------------------------------



}
