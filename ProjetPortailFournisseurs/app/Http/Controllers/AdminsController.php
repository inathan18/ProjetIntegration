<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usager;

class AdminsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    return view('Admins.Panel');
    }

    public function gestionUsagers()
    {
        $usagers = Usager::all();
        return view('Admins.Usagers',  ['usagers' => $usagers]);
    }

    public function parametres()
    {
        return view ('Admins.Parametres');
    }

    public function modelesCourriel()
    {
        return view('Admins.Courriel');
    }

    public function createUser()
    {
        return view('Admins.ajouterUsager');
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:usagers,email',
            'role' => 'required',
        ]);
        $email = $request->input('email');
        $role = $request->input('role');
    
        $usager = new Usager();
        $usager->email = $email;
        $usager->role = $role;
        $usager->save();

        return redirect()->route('Admins.Usagers')->with('new_user_success', 'Le nouvel utilisateur a bien été ajouté');
    }

    public function updateRole(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|string'
        ]);

        try {
            $usager = Usager::findOrFail($id);

            $oldRole = $usager->role;
            $newRole = $request->input('role');

            // Vérification nombre d'administrateurs
            if ($oldRole == 'administrateur' && $newRole != 'administrateur') {
                $adminCount = Usager::where('role', 'administrateur')->where('id', '!=', $usager->id)->count();
                if ($adminCount < 2) {
                    return response()->json(['success' => false, 'message' => 'Impossible de modifier! Il doit toujours y avoir 2 administrateurs.'], 400);
                }
            }

            // Vérification nombre de responsables
            if ($oldRole == 'responsable' && $newRole != 'responsable') {
                $responsableCount = Usager::where('role', 'responsable')->where('id', '!=', $usager->id)->count();
                if ($responsableCount < 1) {
                    return response()->json(['success' => false, 'message' => 'Impossible de modifier! Il doit y avoir au moins un responsable.'], 400);
                }
            }

            // Mise à jour du rôle
            $usager->role = $newRole;
            $usager->save();

            return response()->json(['success' => true]);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    
    
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
        //
    }
}
