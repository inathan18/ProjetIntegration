@extends('layouts.app')

@section('titre', "Mon Dossier")

@section('contenu')

<div class="p-3 text-center"> <h1> Mon Dossier Fournisseur</h1> </div>

<div class="container-fluid h-100">

    <div class="row text-center align-items-center justify-content-center" >
        
        <div class="p3">
            <p> {{$fournisseur_actuel->name}} </p><hr>
            <p> {{$fournisseur_actuel->address}} </p><hr>
            <p> {{$fournisseur_actuel->city}} </p><hr>
            <p> {{$fournisseur_actuel->province}} </p><hr>
            <p> {{$fournisseur_actuel->country}} </p><hr>
            <p> {{$telephone}} </p><hr>
            <p> {{$fournisseur_actuel->postCode}} </p><hr>
            <p> {{$unspsc}} </p><hr>
            <p> {{$fichier}} </p>
            <?php if( $fichier != "Aucun Fichier Envoyé") { ?>
                 <a href="{{route('Fournisseurs.fichier.delete')}}" class="btn btn-danger"> Supprimer le fichier </a>
             <?php } ?>
            <hr>
            <p> {{$fournisseur_actuel->website}} </p><hr>
            <p> {{$fournisseur_actuel->email}} </p><hr>
            <p> {{$fournisseur_actuel->neq}} </p><hr>
            <p> {{$fournisseur_actuel->rbq}} </p><hr>
            <p> {{$fournisseur_actuel->personneContact}} </p><hr>
        </div>

        <form action="{{route('Fournisseurs.fichier.upload')}}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label for="imageID">Sélectionner votre Dossier</label>
                <input type="file" accept=" .pdf, .png, .txt, .docx " class="form-control-file" id="file" name="file[]" multiple>
            </div>

            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </form>

        <hr>

        <a href="{{route('Fournisseurs.edit', [$fournisseur_actuel->id])}}" class="btn btn-warning">
            Modifier mes informations
        </a>

    </div>

</div>

@endsection
