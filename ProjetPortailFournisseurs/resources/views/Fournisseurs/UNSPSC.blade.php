@extends('layouts.app')

@section('titre', "UNSPSC")

@section('contenu')


<div class="p-3 text-center"> <h1> UNSPSC</h1></div>

<!-- Section Inscription -->
    <div class="p-3">
        <label class="form-label" for="unspsc">Entrer: </label>

                @livewire('recherche-u-n-s-p-s-c')
    </div>

    <!-- Fin de la Section Inscription -->

    <div class="align-items-center text-center">
        <a class="btn" href="{{route('Fournisseurs.connexionNEQ')}}" style="background-color: rgba(0, 118, 213,0.9); border-color:black;" type="button">
            Connexion
        </a>
    </div>

    <script src="../localisation.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <x:pharaonic-select2::scripts />

@endsection