<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsagersController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\FournisseursController;

Route::get('/connexion', 
[UsagersController::class, 'index'])->name('Connexion');


Route::get('/', function () {
    return view('welcome');
});

Route::get('/connexionNEQ', 
[UsagersController::class, 'connexionNEQ'])->name('ConnexionNEQ');

Route::get('/CreationCompte', 
[UsagersController::class, 'create'])->name('Usagers.creation');

Route::get('mailable', function () {
    return (new App\Notifications\AcceptationFournisseur())->toMail((object) [])->render();
  });

  Route::post('/email', [FournisseursController::class, 'sendAcceptationEmail'])->name('Fournisseurs.sendAcceptationEmail');