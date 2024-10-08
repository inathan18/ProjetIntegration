@extends('layouts.app')

@section('titre', "Connexion")

@section('contenu')

<div class="p-3 text-center"> <h1> Frame Statut </h1> </div>

<div class="container-fluid h-100">

    <div class="row text-center align-items-center justify-content-center" >
        
        <div class="p3">
            <p> {{$fournisseur_actuel->statut}} </p>
        </div>

    </div>

</div>

@endsection