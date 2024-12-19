@extends('layouts.app')

@section('titre', "Connexion")

@section('contenu')

<div class="p-3 text-center"> <h1>Connexion usagers</h1></div>

{{-- Affichage des messages d'erreur --}}
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <form method="POST" action="{{ route('Usagers.login') }}">
        @csrf

        <div class="p-3">
            <label class="form-label" for="email">Courriel : </label>
            <input class="form-control" type="email" id="email" name="email" value="{{ old('email') }}" required>
        </div>

        <div class="p-3">
            <label class="form-label" for="role">Rôle : </label>
            <select class="form-control" id="role" name="role" required>
                <option value="administrateur">Administrateur</option>
                <option value="responsable">Responsable</option>
                <option value="commis">Commis</option>
            </select>
        </div>

        <div class="align-items-center text-center">
            <button class="btn" style="background-color: rgba(0, 118, 213,0.9); border-color:black;" type="submit">
                Se Connecter
            </button>
        </div>
    </form>

@endsection
