@extends('layouts.app')

@section('titre', "Inscription")

@section('contenu')


<div class="p-3 text-center"> <h1> Frame Inscription </h1></div>

<!-- Section Inscription -->
<form method="post" action="{{route('Usagers.store')}}">

@csrf

    <div class="p-3">
        <label class="form-label" for="email">Courriel : </label>
        <input class="form-control" type="email" id="email" name="email">
    </div>

    <div class="p-3">
        <label class="form-label" for="role">Role : </label>
        <input class="form-control" type="role" id="role" name="role">
    </div>

    <div class="align-items-center text-center">

        <button class="btn" style="background-color: rgba(255,192,203,0.5); border-color: black;" type="submit">
            S'inscrire
        </button>

    </div>
</form>

    <!-- Fin de la Section Inscription -->

    <div class="align-items-center text-center">
        <a class="btn" href="{{route('ConnexionNEQ')}}" style="background-color: rgba(0, 118, 213,0.9); border-color:black;" type="button">
            Connexion
        </a>
    </div>



@endsection