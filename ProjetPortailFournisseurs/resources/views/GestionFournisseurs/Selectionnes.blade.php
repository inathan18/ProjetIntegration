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
    <style>
        .table th, .table td {
            vertical-align: middle;
        }
        .contact-info {
            font-size: 14px;
        }
        .btn-icon {
            font-size: 1.2rem;
            margin-right: 8px;
        }
    </style>
</head>
<body>
    <main>
        <div class="container mt-5">
            @include('layouts.navbarResponsable')
            <h2>Liste des Fournisseurs Sélectionnés</h2>
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Nom</th>
                        <th>Téléphone</th>
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
                            @php
                                // Décoder les informations JSON pour la personne de contact et les numéros
                                $contacts = json_decode($fournisseur->personneContact);
                                $telephones = json_decode($fournisseur->phone);
                            @endphp

                            <tr>
                                <td>{{ $fournisseur->name }}</td>
                                
                                <!-- Affichage des téléphones -->
                                <td>
                                    @if (!empty($telephones) && isset($telephones[1]))
                                        <span class="d-flex align-items-center">
                                            <i class="bi bi-telephone-fill btn-icon"></i>
                                            <a href="tel:{{ $telephones[1] }}" class="text-decoration-none">{{ $telephones[1] }}</a>
                                        </span>
                                    @else
                                        <span class="text-muted">Pas de téléphone</span>
                                    @endif
                                </td>
                                
                                <!-- Affichage de la personne de contact -->
                                <td>
                                    @if (!empty($contacts) && isset($contacts[0]) && isset($contacts[2]))
                                        <span class="contact-info d-flex align-items-center">
                                            <i class="bi bi-person-fill btn-icon"></i>
                                            {{ $contacts[0] }} ({{ $contacts[2] }})
                                        </span>
                                    @else
                                        <span class="text-muted">Pas d'information</span>
                                    @endif
                                </td>
                                
                                <td>
                                    <input type="checkbox" class="form-check-input" value="{{ $fournisseur->id }}">
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>

            <!-- Bouton de retour -->
            <a href="{{ route('fournisseurs.recherche') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left-circle"></i> Retour à la recherche
            </a>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
