@extends('layouts.app')

@section('contenu')
<div>
    @if (session('message'))
        <div>
            {{ session('message') }}
        </div>
    @endif

    <div>
       Veuillez consulter votre boîte de courriel et confirmer celui-ci en cliquant sur le lien
    </div>

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit">Renvoyer le courriel de vérification</button>
    </form>
</div>
@endsection
