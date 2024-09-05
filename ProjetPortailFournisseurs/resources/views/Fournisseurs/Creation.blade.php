@extends('layouts.app')

@section('titre', "Inscription")

@section('contenu')


<div class="p-3 text-center"> <h1> Frame Inscription </h1></div>

<!-- Section Inscription -->
<form method="post" action="{{route('Fournisseurs.store')}}">
@csrf

    <div class="p-3">
        <label class="form-label" for="email">Courriel : </label>
        <input class="form-control" type="email" id="email" name="email">
    </div>

    <div class="p-3">
        <label class="form-label" for="password">Mot de passe : </label>
        <input class="form-control" type="password" id="password" name="password">
    </div>

    <div class="align-items-center text-center">

        <button class="btn" style="background-color: rgba(255,192,203,0.5); border-color: black;" type="submit"
        onclick="var val= document.getElementById('password').value; document.getElementById('password').value(sha512(val));">

            S'inscrire

        </button>

    </div>
</form>

    <!-- Fin de la Section Inscription -->

    <div class="align-items-center text-center">
        <a class="btn" href="{{route('Fournisseurs.connexionNEQ')}}" style="background-color: rgba(0, 118, 213,0.9); border-color:black;" type="button">
            Connexion
        </a>
    </div>



@endsection