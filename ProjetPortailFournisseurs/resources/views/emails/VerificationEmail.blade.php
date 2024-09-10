@extends('layouts.app')

@section('titre', "Vérification du courriel")

@section('contenu')

<h1>Courriel de vérification</h1>

Veuillez vérifier votre adresse courriel en utilisant le lien ci-dessous:
<a href="{{route('fournisseur.verify', $token}}">Vérifier votre courriel</a>

@endsection