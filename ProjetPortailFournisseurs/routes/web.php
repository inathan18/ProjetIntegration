<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsagersController;
use App\Http\Controllers\FournisseursController;

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
