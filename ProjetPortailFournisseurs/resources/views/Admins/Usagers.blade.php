@extends('Admins.Panel')

@section('content')

<body class="p-4">
    <div class="container">
        <h2 class="mb-4">Gestion des utilisateurs</h2>

        <div class="d-flex justify-content-between">
            <table class="table table-bordered" style="width: 75%;">
                <thead class="table-light">
                    <tr>
                        <th>Utilisateur</th>
                        <th>Rôle</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="text" class="form-control" disabled></td>
                        <td>
                            <select class="form-select">
                                <option>Administrateur</option>
                                <option>Commis</option>
                                <option>Responsable</option>
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="d-flex flex-column justify-content-start" style="width: 20%;">
                <button class="btn btn-primary btn-sm mb-2">Ajouter</button> 
                <button class="btn btn-danger btn-sm">Supprimer</button>
            </div>
        </div>

        <div class="mt-4">
            <button class="btn btn-success">Enregistrer les modifications</button>
            <button class="btn btn-secondary">Annuler</button>
        </div>
    </div>
</body>
@endsection
