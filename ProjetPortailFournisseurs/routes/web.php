<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsagersController;
use App\Http\Controllers\AdminsController;

Route::get('/connexion', 
[UsagersController::class, 'index'])->name('Connexion');


Route::get('/', function () {
    return view('welcome');
});

Route::get('/connexionNEQ', 
[UsagersController::class, 'connexionNEQ'])->name('ConnexionNEQ');

Route::get('/CreationCompte', 
[UsagersController::class, 'create'])->name('Usagers.creation');



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
