<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsagersController;


Route::get('/connexion', 
[UsagersController::class, 'index'])->name('Connexion');


Route::get('/', function () {
    return view('welcome');
});

Route::get('/connexionNEQ', 
[UsagersController::class, 'connexionNEQ'])->name('ConnexionNEQ');

Route::get('/CreationCompte', 
[UsagersController::class, 'create'])->name('Usagers.creation');
