<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Fournisseurs sélectionnés</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('assets/favicon.ico') }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="app.css" rel="stylesheet" />    
</head>
<body>
    <main>
        <div class="container mt-5">
        @include('layouts.navbarResponsable')
            <h2>Liste des Fournisseurs Sélectionnés</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Personne Contact</th>
                        <th>Contacté</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($fournisseurs->isEmpty())
                        <tr>
                            <td colspan="4" class="text-center">Aucun fournisseur sélectionné.</td>
                        </tr>
                    @else
                        @foreach ($fournisseurs as $fournisseur)

                            <tr>
                                <td>{{ $fournisseur->name }}</td>
                                <td>{{ $fournisseur->email }}</td>
                                <td>{{ $fournisseur->telephone }}</td>
                                <td>
                                    <input type="checkbox" class="form-check-input" value="{{ $fournisseur->id }}">
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            <a href="{{ route('fournisseurs.recherche') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Retour à la recherche
            </a>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

