@extends('layouts.app')

@section('titre', "Modification")

@section('contenu')

@section('body', "V3R-Blanc")

<div class="p-3 text-center"> <h1> Modifier mes informations </h1> </div>

<div class="container-fluid h-100">

    <div class="row text-center align-items-center justify-content-center" >
        
    <form method="post" action="{{route('Fournisseurs.update', [$fournisseur_actuel])}}">
    @csrf
    @method('PATCH')

        <div class="p3">
            <label class="form-label" for="personneContact">Personne contact: </label>
            <input class="form-control" type="text" id="personneContact" name="personneContact" value="{{old('personneContact', $fournisseur_actuel->personneContact)}}">
        </div>

        <div class="p3">
            <label class="form-label" for="website">Site Web : </label>
            <input class="form-control" type="text" id="website" name="website" value="{{old('website', $fournisseur_actuel->website)}}">
        </div>

        <button class="btn text-white" style="background-color: #092D74;" type="submit">
            Modifier
        </button>

        </form>

    </div>

</div>

@endsection