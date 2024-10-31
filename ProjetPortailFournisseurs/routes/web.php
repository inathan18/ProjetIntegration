<?php
  
use Illuminate\Support\Facades\Route;
  
use App\Http\Controllers\PostController;
use App\Http\Controllers\UsagersController;
use App\Http\Controllers\FournisseursController;
use App\Http\Controllers\AdminsController;
use App\Http\Controllers\ResponsablesController;
use App\Livewire\Recherche;

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

Route::get('/connexion', 
[FournisseursController::class, 'index'])->name('Fournisseurs.connexion');

Route::get('/inscription', 
[FournisseursController::class, 'create'])->name('Fournisseurs.creation');

Route::post('/inscription', 
[FournisseursController::class, 'store'])->name('Fournisseurs.store');

Route::post('/loginFournisseur', 
[FournisseursController::class, 'login'])->name('Fournisseurs.login');

// Routes pour responsables

Route::get('/Recherche', Recherche::class)->name('fournisseurs.recherche');

Route::get('/fournisseurs/selection', [FournisseursController::class, 'showSelected'])->name('fournisseurs.selectionnes');

Route::get('/fournisseurs/{id}', [FournisseursController::class, 'showFiche'])->name('fournisseurs.showFiche');

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

