<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsagersController;


Route::get('/connexion', 
[UsagersController::class, 'index'])->name('Requetes.index');


Route::get('/', function () {
    return view('welcome');
});

Route::get('/connexionNEQ', function () {
    return view('connexionNEQ');
});
