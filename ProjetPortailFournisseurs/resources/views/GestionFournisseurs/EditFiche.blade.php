@extends('layouts.app')

@section('titre', "Dossiers fournisseurs")

@section('contenu')

<div class="container mt-5">
@include('layouts.navbarResponsable')
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
                             <!-- Affichage du statut -->
                            @if ($fournisseur->statut == 'A') <i class="fas fa-check-circle"></i> Acceptée
                            @elseif ($fournisseur->statut == 'AT') <i class="fas fa-hourglass-half"></i> En attente
                            @elseif ($fournisseur->statut == 'AR') <i class="fas fa-exclamation-circle"></i> À réviser
                            @elseif ($fournisseur->statut == 'R') <i class="fas fa-times-circle"></i> Refusée
                            @else <i class="fas fa-info-circle"></i> Statut inconnu
                            @endif
                        </p>

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

            <!-- Adresse et Téléphone -->
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Adresse et Téléphone</h5>
                        
                        <!-- Adresse -->
                        <div class="mb-3">
                            <label for="address" class="form-label">Adresse</label>
                            <input type="text" class="form-control" id="address" name="address" value="{{ $fournisseur->address }}">
                        </div>

                        <!-- Ville -->
                        <div class="mb-3">
                            <label for="city" class="form-label">Ville</label>
                            <input type="text" class="form-control" id="city" name="city" value="{{ $fournisseur->city }}">
                        </div>

                        <!-- Site Internet -->
                        <div class="mb-3">
                            <label for="website" class="form-label">Site Internet</label>
                            <input type="text" class="form-control" id="website" name="website" value="{{ $fournisseur->website }}">
                        </div>

                        <!-- Téléphone -->
                        <div class="mb-3">
                            <label class="form-label">Numéros de Téléphone</label>
                            <div id="phone-container">
                                @php
                                    $phoneData = is_array($fournisseur->phone) ? $fournisseur->phone : json_decode($fournisseur->phone, true);
                                @endphp

                                @if ($phoneData)
                                    @for ($i = 0; $i < count($phoneData); $i += 2)
                                        <div class="row phone-row mb-2">
                                            <div class="col-6">
                                                <input type="text" class="form-control" name="phone_number[]" 
                                                    value="{{ $phoneData[$i] ?? '' }}" 
                                                    placeholder="Numéro de téléphone">
                                            </div>
                                            <div class="col-5">
                                                <input type="text" class="form-control" name="phone_type[]" 
                                                    value="{{ $phoneData[$i+1] ?? '' }}" 
                                                    placeholder="Type (Bureau, Mobile, etc.)">
                                            </div>
                                            <div class="col-1">
                                                <button type="button" class="btn btn-danger remove-phone-row">-</button>
                                            </div>
                                        </div>
                                    @endfor
                                @else
                                    <div class="row phone-row mb-2">
                                        <div class="col-6">
                                            <input type="text" class="form-control" name="phone_number[]" 
                                                placeholder="Numéro de téléphone">
                                        </div>
                                        <div class="col-5">
                                            <input type="text" class="form-control" name="phone_type[]" 
                                                placeholder="Type (Bureau, Mobile, etc.)">
                                        </div>
                                        <div class="col-1">
                                            <button type="button" class="btn btn-danger remove-phone-row">-</button>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <button type="button" id="add-phone-row" class="btn btn-secondary mt-2">
                                <i class="fas fa-plus"></i> Ajouter un numéro
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
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

        // Gestion dynamique des numéros de téléphone
        const phoneContainer = document.getElementById('phone-container');
        const addPhoneRowButton = document.getElementById('add-phone-row');

        addPhoneRowButton.addEventListener('click', function() {
            const newRow = document.createElement('div');
            newRow.classList.add('row', 'phone-row', 'mb-2');
            newRow.innerHTML = `
                <div class="col-6">
                    <input type="text" class="form-control" name="phone_number[]" 
                           placeholder="Numéro de téléphone">
                </div>
                <div class="col-5">
                    <input type="text" class="form-control" name="phone_type[]" 
                           placeholder="Type (Bureau, Mobile, etc.)">
                </div>
                <div class="col-1">
                    <button type="button" class="btn btn-danger remove-phone-row">-</button>
                </div>
            `;
            phoneContainer.appendChild(newRow);
        });

        // Utiliser event delegation pour gérer la suppression des lignes
        phoneContainer.addEventListener('click', function(event) {
            if (event.target.classList.contains('remove-phone-row')) {
                // Empêcher la suppression si c'est la dernière ligne
                if (phoneContainer.querySelectorAll('.phone-row').length > 1) {
                    event.target.closest('.phone-row').remove();
                } else {
                    alert('Vous devez garder au moins un numéro de téléphone.');
                }
            }
        });
    });
</script>
@endsection
