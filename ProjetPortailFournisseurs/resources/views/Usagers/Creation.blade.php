@extends('layouts.app')

@section('titre', "Connexion")

@section('contenu')

<div class="p-3 text-center"> <h1> Frame Creation </h1></div>

    <div class="p-3">
        <label class="form-label" for="NEQ">NEQ : </label>
        <input class="form-control" type="text" id="NEQ" name="NEQ">
    </div>

    <div class="p-3">
        <label class="form-label" for="Courriel">Courriel : </label>
        <input class="form-control" type="email" id="courriel" name="courriel">
    </div>

    <div class="p-3">
        <label class="form-label" for="MotDePasse">Mot de passe : </label>
        <input class="form-control" type="MotDePasse" id="MotDePasse" name="MotDePasse">
    </div>
.
    <button class="btn" style="background-color: rgba(0, 118, 213,0.9); border-color:black;" type="button">
        Creation
    </button>

@endsection