@extends('layouts.app')

@section('titre', "Historique des modifications")

@section('contenu')

<div class="container mt-5">
    <div class="row mb-4">
        <div class="col-12 text-right">
            <a href="{{ route('fournisseurs.showFiche', $fournisseur->id) }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Retour à la fiche
            </a>
        </div>
    </div>

    <h1 class="mb-4">Historique des modifications pour {{ $fournisseur->name }}</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Date de modification</th>
                <th>État de la demande</th>
                <th>Modifié par</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($historique as $item)
            <tr>
                <td>{{ $item->created_at->format('j F Y H:i:s') }}</td>
                <td>
                    @if ($item->statut == 'A') 
                        <i class="fas fa-check-circle text-success"></i> Acceptée
                    @elseif ($item->statut == 'AT') 
                        <i class="fas fa-clock text-warning"></i> En attente
                    @elseif ($item->statut == 'AR') 
                        <i class="fas fa-exclamation-circle text-info"></i> À réviser
                    @elseif ($item->statut == 'R') 
                        <i class="fas fa-times-circle text-danger"></i>
                        <span class="text-primary cursor-pointer text-decoration-underline" onclick="toggleDetails('refus-{{ $item->id }}')"> Refusée</span>
                        <div id="refus-{{ $item->id }}" style="display:none;">
                            <strong>Raison du refus :</strong> {{ $item->raisonRefus }}
                        </div>
                    @elseif ($item->statut == 'D') 
                        <i class="fas fa-ban text-secondary"></i> Désactivée
                    @elseif ($item->statut == 'M') 
                        <i class="fas fa-edit text-info"></i>
                        <span class="text-primary cursor-pointer text-decoration-underline" onclick="toggleDetails('modif-{{ $item->id }}')"> Modifiée</span>
                        <div id="modif-{{ $item->id }}" style="display:none;">
                            <strong>Modifications :</strong>
                            <ul>
                                @foreach ($item->modifications as $key => $modif)
                                    <li>{{ ucfirst($key) }} : {{ $modif }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @else 
                        <i class="fas fa-pencil-alt"></i> Modifié
                    @endif
                </td>
                <td>{{ $item->modifie_par }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@section('scripts')
<script>
    function toggleDetails(elementId) {
        var details = document.getElementById(elementId);
        if (details.style.display === "none") {
            details.style.display = "block";
        } else {
            details.style.display = "none";
        }
    }
</script>
@endsection

@endsection
