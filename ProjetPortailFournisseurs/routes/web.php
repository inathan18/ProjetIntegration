<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsagersController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/connexionNEQ', 
[UsagersController::class, 'connexionNEQ'])->name('ConnexionNEQ');

Route::get('/connexion', 
[UsagersController::class, 'index'])->name('Connexion');

Route::get('/inscription', 
[UsagersController::class, 'create'])->name('Usagers.creation');

Route::post('/inscription', 
[UsagersController::class, 'store'])->name('Usagers.store');

Route::post('/', 
[UsagersController::class, 'login'])->name('Login');
