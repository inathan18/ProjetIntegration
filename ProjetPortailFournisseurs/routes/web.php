<?php
  
use Illuminate\Support\Facades\Route;
  
use App\Http\Controllers\PostController;
use App\Http\Controllers\UsagersController;
use App\Http\Controllers\FournisseursController;
use App\Http\Controllers\AdminsController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Models\Fournisseur;
use App\Models\Usager;
use App\Notifications\BienvenueNotification;
use App\Notifications\ChangementFournisseur;
use App\Notifications\NouveauFournisseur;

// Route pour Usagers

Route::get('/usagers/connexion', 
[UsagersController::class, 'index'])->name('Usagers.connexion');

Route::post('/LoginUsagers', 
[UsagersController::class, 'login'])->name('Usagers.login');



Route::get('/', function () {
    return view('welcome');
});

// Routes pour fournisseurs

Route::get('/fournisseur/accueil', 
[FournisseursController::class, 'accueil'])->name('Fournisseurs.accueil');

Route::get('/fournisseur/statut', 
[FournisseursController::class, 'statut'])->name('Fournisseurs.statut');

Route::get('/fournisseur/edit', 
[FournisseursController::class, 'edit'])->name('Fournisseurs.edit');

Route::get('/fournisseur/connexionNEQ', 
[FournisseursController::class, 'connexionNEQ'])->name('Fournisseurs.connexionNEQ');

Route::get('/fournisseur/connexion', 
[FournisseursController::class, 'index'])->name('Fournisseurs.connexion');

Route::get('/fournisseur/inscription', 
[FournisseursController::class, 'create'])->name('Fournisseurs.creation');

Route::get('/fournisseur/unspsc', 
[FournisseursController::class, 'unspsc'])->name('Fournisseurs.UNSPSC');

Route::post('/fournisseur/inscription', 
[FournisseursController::class, 'store'])->name('Fournisseurs.store');

Route::post('/fournisseur/upload', 
[FournisseursController::class, 'upload'])->name('Fournisseurs.fichier.upload');

Route::post('/loginFournisseur', 
[FournisseursController::class, 'login'])->name('Fournisseurs.login');

Route::get('/fournisseur/deleteFichier', 
[FournisseursController::class, 'fichierDelete'])->name('Fournisseurs.fichier.delete');

Route::get('/fournisseur/monDossier', 
[FournisseursController::class, 'show'])->name('Fournisseurs.dossier');

Route::get('/fournisseur/modification', 
[FournisseursController::class, 'edit'])->name('Fournisseurs.edit');

Route::patch('/fournisseur/{fournisseur}/modification', 
[FournisseursController::class, 'update'])->name('Fournisseurs.update');

//Routes validation courriel
Route::get('/email/verify', function(){
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/fournisseur/accueil');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request){
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Courriel de vérification envoyé!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

//Tests notifications
Route::get('notification/bienvenue', function (){
    $fournisseur = Fournisseur::find(1);

    return (new BienvenueNotification($fournisseur))
    ->toMail($fournisseur);
});

Route::get('notification/modification', function (){
    $fournisseur = Fournisseur::find(1);

    return (new ChangementFournisseur($fournisseur))
    ->toMail($fournisseur);
});

Route::get('notification/nouveau', function (){
    $usager = Usager::find(1);

    return (new NouveauFournisseur($usager))
    ->toMail($usager);
});

Route::get('notification/validation', function(){
    $fournisseur = Fournisseur::find(1);
    return (new Illuminate\Auth\Notifications\VerifyEmail())->toMail($fournisseur);
});






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

