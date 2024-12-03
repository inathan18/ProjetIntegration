@extends('layouts.app')

@section('titre', "Accueil")

@section('contenu')

<form method="POST" action="{{ route('logout') }}" class="d-flex align-items-center">
    @csrf
    <button type="submit" class="btn btn-link nav-link d-flex align-items-center" style="display: inline; padding: 0; margin: 0; border: none;">
        <i class="fas fa-sign-out-alt me-2"></i>
        Déconnexion
    </button>
</form>

@endsection