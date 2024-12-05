@extends('layouts.app')

@section('titre', "Inscription")

@section('contenu')


<div class="p-3 text-center"> <h1> Frame Inscription </h1></div>

<!-- Section Inscription -->
    <div class="p-3">
        <label class="form-label" for="noNeq">Entrer RBQ (si vous détenez une licence RBQ): </label>

                @livewire('validation-r-b-q')
    </div>

    <!-- Fin de la Section Inscription -->

    <div class="align-items-center text-center">
        <a class="btn" href="{{route('Fournisseurs.connexionNEQ')}}" style="background-color: rgba(0, 118, 213,0.9); border-color:black;" type="button">
            Retour Connexion
        </a>
    </div>

    <script src="../localisation.js"></script>

@endsection