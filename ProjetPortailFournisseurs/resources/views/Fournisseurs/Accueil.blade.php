@extends('layouts.app')

@section('titre', "Accueil")

@section('contenu')

@section('body', "V3R-Gris")

<div class="container-fluid">
<div class="row">
<div class="col-6">

    <div class="row">
        <div class="col-6">
            <div class="row">
            <div class="col-1"></div>
            <div class="col-10">

            <div class="card-container">
                <div class="persoCard">
                <div class="card-top text-center">
                <h3> Compagnie </h3>
                </div>
                <div class="card-content">
                    <p> Nom: <br> {{$fournisseur_actuel->name}} </p><hr>
                    <p> Adresse: <br> {{$fournisseur_actuel->address}} </p><hr>
                    <p> Ville: <br> {{$fournisseur_actuel->city}} </p><hr>
                    <p> Province: <br> {{$fournisseur_actuel->province}} </p><hr>
                    <p> Pays: <br> {{$fournisseur_actuel->country}} </p><hr>
                    <p> Telephone: <br> {{$telephone}} </p><hr>
                </div>
                </div>
            </div>

            </div>
            <div class="col-1"></div>
            </div>
        </div>

        <div class="col-6">
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10">

            <div class="card-container">
                <div class="persoCard">
                <div class="card-top text-center">
                <h3> Services Fournis </h3>
                </div>
                <div class="card-content">
                    <p> UNSPSC: <br> {{$unspsc}} </p><hr>

                </div>
                </div>
            </div>

            </div>
            <div class="col-1"></div>
            </div>
        </div>

    </div>

</div>

<div class="col-6">

<div class="row">
        <div class="col-6">
            <div class="row">
            <div class="col-1"></div>
            <div class="col-10">

            <div class="card-container">
                <div class="persoCard">
                <div class="card-top text-center">
                <h3> Documents </h3>
                </div>
                <div class="card-content">

                <p> Fichier: <br> {{$fichier}} </p><hr>
                
                <?php if( $fichier != "Aucun Fichier Envoyé") { ?>
                 <a href="{{route('Fournisseurs.fichier.delete')}}" class="btn btn-danger"> Supprimer le fichier </a>
                <?php } ?>

                </div>
                </div>
            </div>

            </div>
            <div class="col-1"></div>
            </div>
        </div>

        <div class="col-6">
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10">


            <div class="card-container">
                <div class="persoCard">
                <div class="card-top text-center">
                <h3> Compagnie </h3>
                </div>
                <div class="card-content">

                </div>
                </div>
            </div>

            </div>
            <div class="col-1"></div>
            </div>
        </div>

    </div>

</div>
</div>

@endsection