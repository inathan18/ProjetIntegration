@extends('layouts.app')

@section('titre', "Connexion")

@section('contenu')

<div class="p-3 text-center"> <h1> Frame Connexion </h1></div>

    <form method="post" action="{{route('Login')}}">
    @csrf

        <div class="p-3">
            <label class="form-label" for="Courriel">Courriel : </label>
            <input class="form-control" type="email" id="courriel" name="courriel">
        </div>

        <div class="align-items-center text-center">
            <button class="btn" style="background-color: rgba(0, 118, 213,0.9); border-color:black;" type="submit">
                Se Connecter
            </button>
        </div>

    </form>

    <div class="align-items-center text-center">
        <a class="btn" href="{{route('ConnexionNEQ')}}" style="background-color: rgba(0, 118, 213,0.9); border-color:black;" type="button">
            Connexion NEQ
        </a>

        <a class="btn" href="{{route('Usagers.creation')}}" style="background-color: rgba(0, 118, 213,0.9); border-color:black;" type="button">
            S'inscrire
        </a>
    </div>

@endsection