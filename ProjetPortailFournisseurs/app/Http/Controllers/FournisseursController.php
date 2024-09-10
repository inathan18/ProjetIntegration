<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fournisseur;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\FournisseurVerify;
use Hash;
use Mail; 
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use App\Notifications\AcceptationFournisseur;
use App\Http\Controllers\NotificationsController;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Log;
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

    return view('Fournisseurs.Accueil', compact('fournisseurs'));
    }

    /* renvois la page de connexion avec le NEQ pour les Fournisseurs */
    public function connexionNEQ()
    {
        $fournisseurs = Fournisseur::all();

    return view('Fournisseurs.ConnexionNEQ', compact('fournisseurs' /*,'commis', 'responsables', 'administrateurs'*/));
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

    public function sendAcceptationEmail(Request $fournisseur){
        Log::debug($fournisseur);
        Notification::route('smtp', $fournisseur)->notify(new AcceptationFournisseur($fournisseur));
    }

   public function postRegistration(Request $request): RedirectResponse
   {

    $data = $request->all();
    $createFournisseur = $this->create($data);
    $token = Str::random(64);

    FournisseurVerify::create([
        'fournisseur_id' => $createFournisseur->id,
        'token' => $token
    ]);

    Mail::send('email.emailVerificationEmail', ['token' => $token], function($message) use($request){
        $message->to($request->email);
        $message->subject('Courriel de vérification de votre adresse courriel');
    });

    return redirect('dashboard')->withSuccess('');
   }

   public function verifyAccpunt($token): RedirectResponse
   {
    $verifyFournisseur = FournisseurVerify::where('token', $token)->first();

    $message = 'Votre adresse courriel ne peut être identifiée.';

    if(!is_null($verifyFournisseur)){
        $fournisseur = $verifyFournisseur->fournisseur;

        if(!$user->is_email_verified){
            $verifyFournisseur->fournisseur->is_email_verified =1;
            $verifyFournisseur->fournisseur->save();
            $message = "Votre adresse courriel a été vérifiée. Vous pouvez maintenant vous connecter.";
        }
        else {
            $message = "Votre adresse courriel a déjà été vérifié. Vous pouvez vous connecter.";
        }
    }
    return redirect()->route('connexion')->with('message', $message);
   }


}
