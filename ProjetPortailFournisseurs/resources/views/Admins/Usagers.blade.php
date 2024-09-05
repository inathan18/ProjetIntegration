@extends('Admins.Panel')

@section('content')

@if(session('delete_user_denied'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('delete_user_denied') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('delete_user'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('delete_user') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('new_user_success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('new_user_success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<body class="p-4">
    <div class="container">
        <h2 class="mb-4">Gestion des utilisateurs</h2>

        <div class="d-flex justify-content-between">
            <div style="width: 75%;">
                <table class="table table-bordered" id="usersTable">
                    <thead class="table-light">
                        <tr>
                            <th></th>
                            <th>Utilisateur</th>
                            <th>Rôle</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($usagers as $usager)
                        <tr>
                            <td>
                                <form action="{{ route('Admins.Usager.Supprimer', $usager->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">&times;
                                    </button>
                                </form>
                            </td>
                            <td>{{ $usager->email }}</td>
                            <td>
                                <select class="form-select">
                                    <option value="administrateur" {{ $usager->role == 'administrateur' ? 'selected' : '' }}>Administrateur</option>
                                    <option value="commis" {{ $usager->role == 'commis' ? 'selected' : '' }}>Commis</option>
                                    <option value="responsable" {{ $usager->role == 'responsable' ? 'selected' : '' }}>Responsable</option>
                                </select>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex flex-column justify-content-start" style="width: 20%;">
                <a href="{{ route('Admins.Usagers.Creation') }}" class="btn btn-primary btn-sm mb-2">Ajouter</a>
            </div>
        </div>
    </div>
</body>

@endsection
