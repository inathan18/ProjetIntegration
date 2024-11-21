<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FournisseursRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File; 
use Illuminate\Auth\Events\Registered;
use App\Events\AccountModified;
use App\Events\AccountCreated;

use App\Models\Fournisseur;
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
            event(new Registered($fournisseurs));
            event(new AccountCreated($fournisseurs));
            Auth::guard('fournisseur')->login($fournisseurs);
            return redirect()->route('verification.notice')->with('success', 'Nous vous avons envoyé un courriel de vérification. Veuillez cliquer sur le lien reçu par courriel pour confirmer.');
            }
                
            catch (\Throwable $e) {
                Log::debug($e);
                return redirect()->route('Fournisseurs.connexion');
            }
            return redirect()->route('Fournisseurs.connexion');
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


}
