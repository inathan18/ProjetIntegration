<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsagersController;
use App\Http\Controllers\FournisseursController;
use App\Http\Controllers\AdminsController;

Route::get('/connexion', 
[UsagersController::class, 'index'])->name('Connexion');


Route::get('/', function () {
    return view('welcome');
});

Route::get('/connexionNEQ', 
[FournisseursController::class, 'connexionNEQ'])->name('Fournisseurs.connexionNEQ');

Route::get('/connexion', 
[FournisseursController::class, 'index'])->name('Fournisseurs.connexion');

Route::get('/inscription', 
[FournisseursController::class, 'create'])->name('Fournisseurs.creation');

Route::post('/inscription', 
[FournisseursController::class, 'store'])->name('Fournisseurs.store');

Route::post('/', 
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
