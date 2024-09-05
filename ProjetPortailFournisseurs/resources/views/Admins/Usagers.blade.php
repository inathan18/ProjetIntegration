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

@section('content')

<!-- Vos alertes et autre contenu ici -->

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
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">&times;</button>
                                </form>
                            </td>
                            <td>{{ $usager->email }}</td>
                            <td>
                                <select class="form-select role-select" data-user-id="{{ $usager->id }}">
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.role-select').change(function() {
        var userId = $(this).data('user-id');
        var newRole = $(this).val();

        $.ajax({
            url: '/admin/usagers/' + userId + '/update-role',
            method: 'PUT',
            data: {
                role: newRole
            },
            success: function(response) {
                if (response.success) {
                    console.log('Rôle mis à jour avec succès');
                } else {
                    console.error('Échec de la mise à jour du rôle :', response.message);
                }
            },
            error: function(xhr) {
                console.error('Erreur lors de la mise à jour du rôle :', xhr.responseText);
            }
        });
    });
});
</script>


@endsection
