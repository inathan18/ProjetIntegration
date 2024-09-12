<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FournisseursRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

use App\Models\Fournisseur;

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
            $fournisseurs->save();
            }
                
            catch (\Throwable $e) {
                Log::debug($e);
                return redirect()->route('Fournisseurs.login');
            }
            return redirect()->route('Fournisseurs.login');
    }

    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $fournisseur = auth()->guard('fournisseur')->user();

        return view('fournisseur.Modification', compact('fournisseur'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try
        {

            $fournisseur->update([
                'name' => $request->name,
                'password' => Hash::make($request->password),

            ]);

            return redirect()->route('fournisseur.accueil')->with('message', "Modification de " . $usager->nom . " réussi!");
        }
        catch(\Throwable $e)
        {
            Log::debug($e);
            return redirect()->route('fournisseur.accueil')->withErrors(["la modification n'a pas fonctionné"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


}
