@extends('layouts.app')

@section('titre', "Connexion")

@section('contenu')

<div class="p-3 text-center"> <h1> Frame Connexion </h1></div>

    <div class="p-3">
        <label class="form-label" for="NEQ">NEQ : </label>
        <input class="form-control" type="text" id="NEQ" name="NEQ">
    </div>

    <div class="p-3">
        <label class="form-label" for="MotDePasse">Mot de passe : </label>
        <input class="form-control" type="MotDePasse" id="MotDePasse" name="MotDePasse">
    </div>

    <div class="align-items-center text-center">
        <button class="btn" style="background-color: rgba(0, 118, 213,0.9); border-color:black;" type="button">
            Se Connecter
        </button>
        
        <a class="btn" href="{{route('Connexion')}}" style="background-color: rgba(0, 118, 213,0.9); border-color:black;" type="button">
            Connexion Courriel
        </a>

        <a class="btn" href="{{route('Usagers.creation')}}" style="background-color: rgba(0, 118, 213,0.9); border-color:black;" type="button">
            S'inscrire
        </a>
    </div>

@endsection