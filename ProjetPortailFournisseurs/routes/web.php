<?php
  
use Illuminate\Support\Facades\Route;
  
use App\Http\Controllers\PostController;
use App\Http\Controllers\UsagersController;
use App\Http\Controllers\FournisseursController;
use App\Http\Controllers\AdminsController;
use App\Http\Controllers\EmailVerificationController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Models\Fournisseur;
use App\Models\Usager;
use App\Notifications\BienvenueNotification;
use App\Notifications\ChangementFournisseur;
use App\Notifications\NouveauFournisseur;
use App\Notifications\ChangementStatut;
use Illuminate\Support\Facades\Log;
use App\Http\Middleware\EnsureEmailIsNotVerified;
use App\Http\Controllers\ResponsablesController;
use App\Http\Controllers\NotificationTemplateController;
use App\Livewire\Recherche;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsAuthorized;

// Route pour Usagers

Route::get('/usagers/connexion', 
[UsagersController::class, 'index'])->name('Usagers.connexion');

Route::post('/LoginUsagers', 
[UsagersController::class, 'login'])->name('Usagers.login');

Route::post('/logout', [UsagersController::class, 'logout'])->name('logout');


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
Route::get('/email/verify', [EmailVerificationController::class, 'show'])->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request){
    $request->user()->sendEmailVerificationNotification();
    Log::Debug($request);

    return back()->with('message', 'Courriel de vérification envoyé!');
})->middleware(['auth:fournisseur', 'throttle:6,1', EnsureEmailIsNotVerified::class])->name('verification.send');

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
    $fournisseur = Fournisseur::find(1);

    return (new NouveauFournisseur($fournisseur, $usager))
    ->toMail($usager);
});

Route::get('notification/statut', function (){
    $usager = Usager::find(1);

    return (new ChangementStatut($usager))
    ->toMail($usager);
});


Route::get('notification/validation', function(){
    $fournisseur = Fournisseur::find(1);
    return (new Illuminate\Auth\Notifications\VerifyEmail())->toMail($fournisseur);
});

Route::get('/send-mail', function(){
    \Mail::raw('This is a test email', function($message){
        $message->to('nathan.lafreniere@gmail.com')->subject('Test Email');
        
    });
    return 'Email sent!';
});


// Routes pour responsables et commis

Route::middleware([IsAuthorized::class])->group(function () {
    Route::get('/Recherche', Recherche::class)->name('fournisseurs.recherche');

    Route::get('/fournisseurs/selection', [FournisseursController::class, 'showSelected'])->name('fournisseurs.selectionnes');

    Route::get('/fournisseurs/{id}', [FournisseursController::class, 'showFiche'])->name('fournisseurs.showFiche');

    Route::get('/fournisseurs/{id}/historique', [FournisseursController::class, 'showHistorique'])->name('fournisseurs.historique');

    Route::get('/fournisseurs/{id}/edit', [FournisseursController::class, 'editFiche'])->name('fournisseurs.editFiche');

    Route::put('/fournisseurs/{id}/modifier', [FournisseursController::class, 'modifierFournisseur'])->name('fournisseurs.modifierFournisseur');
    
    Route::put('/fournisseurs/{id}/modifieretat', [FournisseursController::class, 'modifierEtatFournisseur'])->name('fournisseurs.modifierEtatFournisseur');

});



Route::middleware([IsAdmin::class])->group(function () {
    Route::get('/admin', [AdminsController::class, 'index'])->name('Admins.Panel');
    
    Route::get('/admin/usagers', [AdminsController::class, 'gestionUsagers'])->name('Admins.Usagers');
    
    Route::get('/admin/usagers/nouveau', [AdminsController::class, 'createUser'])->name('Admins.Usagers.Creation');
    
    Route::post('/admin/usagers/add', [AdminsController::class,'storeUser'])->name('Admin.Usager.Store');
    
    Route::get('/admin/parametres', [AdminsController::class, 'parametres'])->name('Admins.Parametres');
    
    Route::get('/admin/courriel', [NotificationTemplateController::class, 'showForm'])->name('NotificationTemplate.showForm');
    
    Route::delete('/admin/usagers/{id}', [UsagersController::class,'destroy'])->name('Admins.Usager.Supprimer');
    
    Route::put('/admin/usagers/{id}/update-role', [AdminsController::class, 'updateRole'])->name('Admins.Usager.UpdateRole'); 
    
    Route::post('/admin/courriel/fetchTemplate',
    [NotificationTemplateController::class, 'fetchTemplate'])->name('NotificationTemplate.fetchTemplate');

    Route::post('/admin/courriel/update',
    [NotificationTemplateController::class, 'update'])->name('NotificationTemplate.update');
});