@extends('layouts.app')

@section('titre', "Accueil")

@section('contenu')

@section('body', "V3R-Gris")

<div class="container-fluid">
<div class="row">
<div class="col-6">
<form method="POST" action="{{ route('Fournisseur.logout') }}" class="d-flex align-items-center">
    @csrf
    <button type="submit" class="btn btn-link nav-link d-flex align-items-center" style="display: inline; padding: 0; margin: 0; border: none;">
        <i class="fas fa-sign-out-alt me-2"></i>
        Déconnexion
    </button>
</form>

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
                

                </div>
                    <div class="card-bot text-center align-self-center"     <?php if( $fichier != "Aucun Fichier Envoyé") { ?> style="height: 100px; !important"                         <?php } ?>>
                        <div class="col-12">
                            <form action="{{route('Fournisseurs.fichier.upload')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                                <div class="row align-self-center">
                                    <div class="form-group col-6">
                                        <input type="file" accept=" .pdf, .png, .txt, .docx " class="form-control-file" id="file" name="file[]" style="color:white;" multiple>
                                    </div>

                                    <div class="col-6">
                                        <button type="submit" class="btn" style="background-color: #FFFFFF; border-color: black; color:black;">Enregistrer</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <?php if( $fichier != "Aucun Fichier Envoyé") { ?>
                            <div class="col-12 align-self-center">
                                <a href="{{route('Fournisseurs.fichier.delete')}}" class="btn align-self-center"> Supprimer le fichier </a>     
                            </div>
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
                <h3> Personne Contact </h3>
                </div>
                <div class="card-content">

                <p> Contact 1 : <br> {{$PersonnesContact[0]}} </p><hr>

                <p> Compte : <br> {{count($PersonnesContact)}} </p><hr>

                </div>
                </div>
            </div>

            </div>
            <div class="col-1"></div>
            </div>
        </div>

    </div>

</div>

<div class="col-12">
    <div class="text-center">
    <a href="{{route('Fournisseurs.edit')}}" class="btn align-self-center" style="background-color: #FFFFFF; border-color: black; color:black;"> Modifier les informations </a>
    </div>
</div>
</div>

@endsection