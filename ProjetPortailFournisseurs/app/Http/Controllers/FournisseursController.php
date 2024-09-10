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

class FournisseursController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
