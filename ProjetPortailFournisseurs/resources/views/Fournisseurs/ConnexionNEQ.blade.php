@extends('layouts.app')

@section('titre', "Connexion")

@section('contenu')

<div class="p-3 text-center"> <h1> Frame Connexion </h1></div>

    <form method="post" action="{{route('Fournisseurs.login')}}">
        @csrf

        <div class="p-3">
            <label class="form-label" for="NEQ">NEQ : </label>
            <input class="form-control" type="text" id="NEQ" name="NEQ">
        </div>

        <div class="p-3">
            <label class="form-label" for="password">Mot de passe : </label>
            <input class="form-control" type="password" id="password" name="password">
        </div>

        <div class="align-items-center text-center">
            <button class="btn" style="background-color: rgba(0, 118, 213,0.9); border-color:black;" type="submit">
                Se Connecter
            </button>
        </div>

    </form>

    <div class="align-items-center text-center">
        
        <a class="btn" href="{{route('Fournisseurs.connexion')}}" style="background-color: rgba(0, 118, 213,0.9); border-color:black;" type="button">
            Connexion Courriel
        </a>

        <a class="btn" href="{{route('Fournisseurs.creation')}}" style="background-color: rgba(0, 118, 213,0.9); border-color:black;" type="button">
            S'inscrire
        </a>
    </div>

@endsection