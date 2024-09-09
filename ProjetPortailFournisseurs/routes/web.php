<?php
  
use Illuminate\Support\Facades\Route;
  
use App\Http\Controllers\PostController;
use App\Http\Controllers\UsagersController;
use App\Http\Controllers\FournisseursController;
use App\Http\Controllers\AdminsController;

// Route pour Usagers

Route::get('/connexionUsagers', 
[UsagersController::class, 'index'])->name('Usagers.connexion');

Route::post('/LoginUsagers', 
[UsagersController::class, 'login'])->name('Usagers.login');

Route::get('/', function () {
    return view('welcome');
});

// Routes pour fournisseurs

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



// Routes admin
Route::get('/admin', 
[AdminsController::class, 'index'])->name('Admins.Panel');

Route::get('/admin/usagers', 
[AdminsController::class, 'gestionUsagers'])->name('Admins.Usagers');

Route::get('/admin/parametres', 
[AdminsController::class, 'parametres'])->name('Admins.Parametres');

Route::get('/admin/courriel', 
[AdminsController::class, 'modelesCourriel'])->name('Admins.Courriel');
