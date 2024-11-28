<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FournisseursRequest;
use App\Http\Requests\HistoriqueRequest;
use App\Models\Fournisseur;
use App\Models\Historique;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File; 
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

    return view('Fournisseurs.Accueil', compact('fournisseurs', 'fournisseur_actuel'));
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

    public function unspsc(){
        return view('Fournisseurs.UNSPSC');
    }


    /* Fonction utilisé pour connecter le Fournisseur a son compte */
    public function login(Request $request)
    {
        $reussi = (auth()->guard('fournisseur')->attempt(['email' => $request->email, 'password' => $request->password]));
        Log::debug(''.$reussi);

        if($reussi){
            $fournisseur = Fournisseur::Where('email', $request->email)->firstOrFail();
            return redirect()->route('Fournisseurs.accueil')->with('message', "Connexion réussi");
        }
        else{
            return redirect()->route('Fournisseurs.login')->withErrors(['Informations invalides']);
        }
    }

    /* fonction utilisé pour la création de compte Fournisseur*/
    public function store(Request $request)
    {
        try {
            $fournisseurs = new Fournisseur($request->all());
            Log::debug($fournisseurs);
            $fournisseurs->postCode = str_replace(' ', '', $fournisseurs->postcode);
            $fournisseurs->save();
            }
                
            catch (\Throwable $e) {
                Log::debug($e);
                return redirect()->route('Fournisseurs.login');
            }
            return redirect()->route('Fournisseurs.login');
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

        // Vérifier si le champ unspsc est déjà un tableau ou une chaîne JSON
        $codesUnspsc = is_string($fournisseur->unspsc) ? json_decode($fournisseur->unspsc, true) : $fournisseur->unspsc;

        // Charger les données du fichier unspsc.json
        $unspscData = json_decode(Storage::get('unspsc.json'), true);

        // Créer un tableau avec les descriptions des produits et services
        $produitsServices = [];
        foreach ($codesUnspsc as $code) {
            foreach ($unspscData as $item) {
                if ($item['codeUnspsc'] == $code) {
                    $produitsServices[] = $item['codeUnspsc'] . ' - ' . $item['descUnspsc'];
                }
            }
        }

        return view('GestionFournisseurs.FicheFournisseur', [
            'fournisseur' => $fournisseur,
            'produitsServices' => $produitsServices,
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

        try {


            $ctr = count($fournisseur_actuel->files);

            Log::debug($ctr);

            Log::debug($fournisseur_actuel->files[2]);

            $fichier = "";
            
            for( $i = 0; $i < $ctr; $i++ ) {
                $fichier .= $fournisseur_actuel->files[$i] . " | " ;
            }
            
            if($fichier == "") {
                $fichier = "Aucun Fichier Envoyé";
            }
        }
        catch (\Throwable $e) {
            $fichier = "Aucun Fichier Envoyé";
        }

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

        $ctr = count($fournisseur_actuel->files);
        
        for( $i = 0; $i < $ctr; $i++ ) {
            $filename = $fournisseur_actuel->files[$i];

            unlink(storage_path('app/fournisseur/' .$filename));
            Storage::delete($filename);
        }

        $fournisseur_actuel->update([
            'files' => [""],

        ]);



        return view('Fournisseurs.accueil');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fournisseur $fournisseur)
    {
        try
        {

            $fournisseur->update([
                'personneContact' => $request->personneContact,
                'website' => $request->website,

            ]);

            return redirect()->route('fournisseur.accueil')->with('message', "Modification de " . $fournisseur->name . " réussi!");
        }
        catch(\Throwable $e)
        {
            Log::debug($e);
            return redirect()->route('Fournisseurs.dossier')->withErrors(["la modification n'a pas fonctionné"]);
        }
    }

    public function upload(Request $request) {

        

        $fournisseur_actuel = auth()->guard('fournisseur')->user();

        if ($request->hasfile('file')) {
            $fileJSON = array();
            $i = 0 ;
            foreach ($request->file('file') as $file) {

                Log::debug($file->extension());

                $extension = ".".$file->extension();

                $filename = pathinfo($file, PATHINFO_FILENAME);
                $destinationPath = "fournisseur";
                Storage::disk()->putfileas($destinationPath, $file, $filename .$extension);
                $fileJSON[$i] = $filename.$extension;
               $i++;
            }
            $fournisseur_actuel->update([
                'files' => $fileJSON,

            ]);
        }

        return redirect()->route('Fournisseurs.accueil');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
    }


}
