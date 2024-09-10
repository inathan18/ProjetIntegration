<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UsagerRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

use App\Models\Usager;

class UsagersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usagers = Usager::all();
        //$fournisseurs = Usager::all()->where('role', 'like', 'fournisseur');
        //$commis = Usager::all()->where('role', 'like', 'commis');
        //$responsables = Usager::all()->where('role', 'like', 'responsable');
        //$administrateurs = Usager::all()->where('role', 'like', 'administrateur');

    return view('Usagers.Connexion', compact('usagers'/*, 'fournisseurs', 'commis', 'responsables', 'administrateurs'*/));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Usagers.Creation');
    }

    public function login(Request $request)
    {
        $reussi = (auth()->guard('usager')->attempt(['email' => $request->email, 'password' => $request->password]));
        Log::debug(''.$reussi);

        if($reussi){
            return redirect()->route('Fournisseurs.accueil')->with('message', "Connexion réussi");
        }
        else{
            return redirect()->route('Usagers.login')->withErrors(['Informations invalides']);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $usagers = new Usager($request->all());
            Log::debug($usagers);
            $usagers->save();
            }
                
            catch (\Throwable $e) {
                Log::debug($e);
            }
            return redirect()->route('Usagers.login');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
