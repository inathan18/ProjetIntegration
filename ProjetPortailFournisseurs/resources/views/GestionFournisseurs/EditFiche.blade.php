@extends('layouts.app')

@section('titre', "Dossiers fournisseurs")

@section('contenu')

<div class="container mt-5">
    <form action="{{ route('fournisseurs.modifierFournisseur', ['id' => $fournisseur->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Boutons en haut -->
        <div class="row mb-4">
            <div class="col-12 d-flex gap-2 justify-content-between">
                <a href="{{ route('fournisseurs.showFiche', ['id' => $fournisseur->id]) }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Retour à la fiche
                </a>
                <button type="submit" class="btn btn-primary">Sauvegarder les modifications</button>
            </div>
        </div>

        <h1 class="mb-4">Fiche Fournisseur</h1>

        <div class="row">
            <!-- État de la demande -->
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">État de la demande</h5>
                        <p class="card-text 
                            @if ($fournisseur->statut == 'A') text-success
                            @elseif ($fournisseur->statut == 'AT') text-warning
                            @elseif ($fournisseur->statut == 'AR') text-primary
                            @elseif ($fournisseur->statut == 'R') text-danger
                            @endif">
                            
                            @if ($fournisseur->statut == 'A')
                                <i class="fas fa-check-circle"></i> Acceptée
                            @elseif ($fournisseur->statut == 'AT')
                                <i class="fas fa-hourglass-half"></i> En attente
                            @elseif ($fournisseur->statut == 'AR')
                                <i class="fas fa-exclamation-circle"></i> À réviser
                            @elseif ($fournisseur->statut == 'R')
                                <i class="fas fa-times-circle"></i> Refusée
                            @else
                                <i class="fas fa-info-circle"></i> Statut inconnu
                            @endif
                        </p>

                        <div class="d-flex justify-content-between">
                            <div>
                                <p>Dernière modification : <span>{{ date('d-m-y', strtotime($fournisseur->updated_at)) }}</span></p>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="etatDemande" class="form-label">Sélectionner l'état</label>
                            <select class="form-select" id="etatDemande" name="statut" required>
                                <option value="A" @if($fournisseur->statut == 'A') selected @endif>Acceptée</option>
                                <option value="AT" @if($fournisseur->statut == 'AT') selected @endif>En attente</option>
                                <option value="AR" @if($fournisseur->statut == 'AR') selected @endif>À réviser</option>
                                <option value="R" @if($fournisseur->statut == 'R') selected @endif>Refusée</option>
                            </select>
                        </div>

                        <div class="mb-3" id="raisonRefus" style="display: none;">
                            <label for="raison" class="form-label">Raison du refus</label>
                            <textarea class="form-control" id="raison" name="raison" rows="3" placeholder="Indiquer la raison du refus"></textarea>
                        </div>

                        <div class="form-check" id="inclusRaison" style="display: none;">
                            <input class="form-check-input" type="checkbox" id="checkboxRaison" name="inclusRaison">
                            <label class="form-check-label" for="checkboxRaison">
                                Inclure la raison du refus dans le courriel
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Identification -->
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Identification</h5>
                        <div class="mb-3">
                            <label for="neq" class="form-label">NEQ</label>
                            <input type="text" class="form-control" id="neq" name="neq" value="{{ $fournisseur->neq }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $fournisseur->name }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Courriel</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $fournisseur->email }}" required>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="row">
        <!-- Adresse -->
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Adresse</h5>
                    <p>{{ $fournisseur->address }}, {{ $fournisseur->city }}</p>
                    <p>Site internet : {{ $fournisseur->website }}</p>
                    <p>Téléphone : </p>
                </div>
            </div>
        </div>

        <!-- Contacts -->
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Contacts</h5>
                    <p>{{ $fournisseur->personneContact }}</p>
                    <p>Courriel : </p>
                    <p>Téléphone : </p>
                </div>
            </div>
        </div>

        <!-- Produits et services offerts -->
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Produits et services offerts</h5>
                    <p>Catégorie :</p>
                    <ul>
                        <li></li>
                        <li></li>
                        <li></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Licence RBQ -->
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Licence RBQ</h5>
                    <p>Numéro : </p>
                    <p class="text-success">
                        <i class="fas fa-check-circle"></i> Valide
                    </p>
                    <p>Catégories : </p>
                </div>
            </div>
        </div>

        <!-- Finances -->
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Finances</h5>
                    <p>TPS : </p>
                    <p>TVQ : </p>
                    <p>Conditions de paiement :</p>
                    <p>Devise : </p>
                    <p>Mode de communication : </p>
                </div>
            </div>
        </div>

        <!-- Brochures et cartes d'affaires -->
        <div class="col-md-12 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Brochures et cartes d'affaires</h5>
                    <ul>
                        <li><a href="#"></a></li>
                        <li><a href="#"></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const etatDemandeSelect = document.getElementById('etatDemande');
        const raisonRefus = document.getElementById('raisonRefus');
        const inclusRaison = document.getElementById('inclusRaison');

        // Afficher/masquer les champs en fonction de l'état sélectionné
        function toggleRefusFields() {
            if (etatDemandeSelect.value === 'R') {
                raisonRefus.style.display = 'block';
                inclusRaison.style.display = 'block';
            } else {
                raisonRefus.style.display = 'none';
                inclusRaison.style.display = 'none';
            }
        }
        toggleRefusFields();
        etatDemandeSelect.addEventListener('change', toggleRefusFields);
    });
</script>
@endsection
