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
        $fillable = Usager::all();
        //$fournisseurs = Usager::all()->where('role', 'like', 'fournisseur');
        //$commis = Usager::all()->where('role', 'like', 'commis');
        //$responsables = Usager::all()->where('role', 'like', 'responsable');
        //$administrateurs = Usager::all()->where('role', 'like', 'administrateur');

    return view('Usagers.Connexion', compact('fillable'/*, 'fournisseurs', 'commis', 'responsables', 'administrateurs'*/));
    }

    public function connexionNEQ()
    {
        $fillable = Usager::all();
        //$fournisseurs = Usager::all()->where('role', 'like', 'fournisseur');
        //$commis = Usager::all()->where('role', 'like', 'commis');
        //$responsables = Usager::all()->where('role', 'like', 'responsable');
        //$administrateurs = Usager::all()->where('role', 'like', 'administrateur');

    return view('Usagers.ConnexionNEQ', compact('fillable'/*, 'fournisseurs', 'commis', 'responsables', 'administrateurs'*/));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Usagers.Creation');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        $usager = Usager::find($id);
        if (!$usager) 
        {
            return redirect()->back()->with(['delete_user_denied' => 'Utilisateur non trouvé!']);
        }

        // Vérification nombre d'admins
        if ($usager->role == 'administrateur') 
        {
            $adminCount = Usager::where('role', 'administrateur')->count();
            if ($adminCount <= 2) 
            {
                return redirect()->back()->with(['delete_user_denied' => 'Impossible de supprimer! Il doit toujours y avoir au moins 2 administrateurs.']);
            }
        }

        // Vérification nombre de responsables
        if ($usager->role == 'responsable') 
        {
            $responsableCount = Usager::where('role', 'responsable')->count();
            if ($responsableCount <= 1) 
            {
                return redirect()->back()->with(['delete_user_denied' => 'Impossible de supprimer! Il doit y avoir au moins un responsable.']);
            }
        }

        $usager->delete();
        return redirect()->back()->with(['delete_user' => 'Suppression réussie']);
    }
}
