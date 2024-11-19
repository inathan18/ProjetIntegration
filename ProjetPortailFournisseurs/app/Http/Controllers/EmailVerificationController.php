<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use App\Models\Fournisseur;


class EmailVerificationController extends Controller
{

    public function show(){
        return view('auth.verify-email');
    }

    public function verify($id, $hash){
        $user = Fournisseur::findOrFail($id);
        if (! hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
            return redirect()->route('verification.notice')->with('fail', 'Lien de vérification invalide.');
        }
        if ($user->hasVerifiedEmail()) {
            return redirect()->route('Fournisseurs.accueil')->with('message', 'Courriel déjà vérifié.');
        }
        $user->markEmailAsVerified();
        event(new Verified($user));
        return redirect()->route('Fournisseurs.connexion')->with('verified', true);

    }


}
