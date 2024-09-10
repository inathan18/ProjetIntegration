<?php
  
use Illuminate\Support\Facades\Route;
  
use App\Http\Controllers\PostController;
use App\Http\Controllers\UsagersController;
use App\Http\Controllers\FournisseursController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\FournisseursController;
use App\Http\Controllers\AdminsController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

// Route pour Usagers

Route::get('/connexionUsagers', 
[UsagersController::class, 'index'])->name('Usagers.connexion');

Route::post('/LoginUsagers', 
[UsagersController::class, 'login'])->name('Usagers.login');



Route::get('/', function () {
    return view('welcome');
});

// Routes pour fournisseurs

Route::get('/Accueil', 
[FournisseursController::class, 'accueil'])->name('Fournisseurs.accueil');

Route::get('/connexionNEQ', 
[FournisseursController::class, 'connexionNEQ'])->name('Fournisseurs.connexionNEQ');

Route::get('/CreationCompte', 
[UsagersController::class, 'create'])->name('Usagers.creation');

Route::get('mailable', function () {
    return (new App\Notifications\AcceptationFournisseur())->toMail((object) [])->render();
  });

  Route::post('/email', [FournisseursController::class, 'sendAcceptationEmail'])->name('Fournisseurs.sendAcceptationEmail');


// Routes admin
Route::get('/admin', 
[AdminsController::class, 'index'])->name('Admins.Panel');

Route::get('/admin/usagers', 
[AdminsController::class, 'gestionUsagers'])->name('Admins.Usagers');

Route::get('/admin/usagers/nouveau', 
[AdminsController::class, 'createUser'])->name('Admins.Usagers.Creation');

Route::post('/admin/usagers/add', 
[AdminsController::class,'storeUser'])->name('Admin.Usager.Store');

Route::get('/admin/parametres', 
[AdminsController::class, 'parametres'])->name('Admins.Parametres');

Route::get('/admin/courriel', 
[AdminsController::class, 'modelesCourriel'])->name('Admins.Courriel');

Route::delete('/admin/usagers/{id}',
[UsagersController::class,'destroy'])->name('Admins.Usager.Supprimer');

Route::put('/admin/usagers/{id}/update-role',
[AdminsController::class, 'updateRole'])->name('Admins.Usager.UpdateRole');
//Email Verification
Route::get('dashboard', [FournisseursController::class, 'dashboard'])->middleware(['auth', 'is_verify_email']);
Route::get('compte/verify/{token}', [FournisseursController::class, 'verifyAccount'])->name('fournisseur.verify');
?>
