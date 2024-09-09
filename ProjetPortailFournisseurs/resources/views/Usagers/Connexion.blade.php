@extends('layouts.app')

@section('titre', "Connexion")

@section('contenu')

<div class="p-3 text-center"> <h1> Frame Connexion </h1></div>

    <form method="post" action="{{route('Usagers.login')}}">
    @csrf

        <div class="p-3">
            <label class="form-label" for="email">Courriel : </label>
            <input class="form-control" type="email" id="email" name="email">
        </div>

        <div class="align-items-center text-center">
            <button class="btn" style="background-color: rgba(0, 118, 213,0.9); border-color:black;" type="submit">
                Se Connecter
            </button>
        </div>

    </form>

@endsection