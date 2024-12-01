@extends('layouts.app')

@section('titre', "Dossiers fournisseurs")

@section('contenu')

<div class="container mt-5">
@include('layouts.navbarResponsable')
    <!-- Bouton de retour -->
    <div class="row mb-4">
        <div class="col-12 text-right">
            <a href="{{ route('fournisseurs.recherche') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Retour à la recherche
            </a>
        </div>
    </div>

    <h1 class="mb-4">Fiche Fournisseur</h1>
    <div class="row">
        <!-- État de la demande -->
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">État de la demande</h5>
                    
                    <!-- Statut et icône -->
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

                    <!-- Formulaire de changement d'état (caché initialement) -->
                    @if(in_array(auth()->guard('usager')->user()->role, ['responsable', 'administrateur']))
                        <!-- Bouton pour afficher/masquer le formulaire de changement d'état -->
                        <button type="button" class="btn btn-warning mt-3" id="btnChangeEtat">
                            Modifier l'état
                        </button>
                        
                        <!-- Formulaire caché -->
                        <div id="formChangeEtat" style="display: none;">
                            <form action="{{ route('fournisseurs.modifierEtatFournisseur', ['id' => $fournisseur->id]) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <!-- Sélection de l'état -->
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

                                <!-- Bouton de sauvegarde -->
                                <button type="submit" class="btn btn-primary mt-3">Sauvegarder les modifications</button>
                            </form>
                        </div>
                    @endif
                    
                    <!-- Dates de création et de dernière modification -->
                    <div class="d-flex justify-content-between">
                        <div>
                            <p>Dernière modification : <span>{{ date('d-m-y', strtotime($fournisseur->updated_at)) }}</span></p>
                        </div>
                    </div>
                    @if(in_array(auth()->guard('usager')->user()->role, ['responsable', 'administrateur']))
                        <!-- Boutons réservés aux responsables -->
                        <a href="{{ route('fournisseurs.historique', $fournisseur->id) }}" class="btn btn-secondary mt-3">Historique des modifications</a>
                        <a href="{{ route('fournisseurs.editFiche', $fournisseur->id) }}" class="btn btn-secondary mt-3">Modifier la fiche</a>
                    @endif

                </div>
            </div>
        </div>



        <!-- Identification -->
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Identification</h5>
                    <p>NEQ : {{ $fournisseur->neq }}</p>
                    <p>Nom : {{ $fournisseur->name }}</p>
                    <p>Courriel : {{ $fournisseur->email }}</p>
                </div>
            </div>
        </div>

        <!-- Adresse -->
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Adresse</h5>
                    <p>{{ $fournisseur->address }}, {{ $fournisseur->city }}</p>
                    <p>Site internet : {{ $fournisseur->website }}</p>
                    <p>Téléphone : 
                        @if ($fournisseur->phone)
                            @php
                                $phoneData = is_array($fournisseur->phone) ? $fournisseur->phone : json_decode($fournisseur->phone, true);
                                
                                // Fonction de formatage du numéro de téléphone
                                function formatPhoneNumber($number) {
                                    // Supprimer tous les caractères non numériques
                                    $cleaned = preg_replace('/\D/', '', $number);
                                    
                                    // Vérifier la longueur du numéro
                                    if (strlen($cleaned) == 10) {
                                        return substr($cleaned, 0, 3) . '-' . 
                                            substr($cleaned, 3, 3) . '-' . 
                                            substr($cleaned, 6, 4);
                                    } elseif (strlen($cleaned) == 11 && substr($cleaned, 0, 1) == '1') {
                                        return '1-' . 
                                            substr($cleaned, 1, 3) . '-' . 
                                            substr($cleaned, 4, 3) . '-' . 
                                            substr($cleaned, 7, 4);
                                    }
                                    
                                    // Si le format n'est pas standard, retourner le numéro original
                                    return $number;
                                }
                            @endphp
                            @if (!empty($phoneData))
                                <ul class="list-unstyled">
                                    @for ($i = 0; $i < count($phoneData); $i += 2)
                                        <li>
                                            {{ formatPhoneNumber($phoneData[$i]) }} 
                                            @if (isset($phoneData[$i+1]) && !empty(trim($phoneData[$i+1])))
                                                ({{ $phoneData[$i+1] }})
                                            @endif
                                        </li>
                                    @endfor
                                </ul>
                            @else
                                Téléphone non disponible
                            @endif
                        @else
                            Téléphone non disponible
                        @endif
                    </p>
                </div>
            </div>
        </div>

        <!-- Contacts -->
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Contacts</h5>
                    <p>{{ $fournisseur->personneContact }}</p>
                    <p>Email : </p>
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
                        @foreach($produitsServices as $produitService)
                            <li>{{ $produitService }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <!-- Licence RBQ -->
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Licence RBQ</h5>
                    @if($fournisseur->rbq)
                        <p>Numéro : 
                            <span>{{ chunk_split($fournisseur->rbq, 4, '-') }}</span>
                        </p>
                        <p class="text-success">
                            <i class="fas fa-check-circle"></i> Valide
                        </p>
                    @else
                        <p>Numéro : <span class="text-muted">Non renseigné</span></p>
                        <p class="text-danger">
                            <i class="fas fa-times-circle"></i> Invalide ou non fourni
                        </p>
                    @endif
                    <p>Catégories :</p>
                    <ul>
                        @foreach($licencesRbq as $licenceRbq)
                            <li>{{ $licenceRbq }}</li>
                        @endforeach
                    </ul>
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
    const btnChangeEtat = document.getElementById('btnChangeEtat');
    const formChangeEtat = document.getElementById('formChangeEtat');

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

    // Initialisation de l'affichage des champs selon l'état initial
    toggleRefusFields();

    // Écouteur pour afficher/masquer les champs lors de la sélection de l'état
    etatDemandeSelect.addEventListener('change', toggleRefusFields);

    // Affichage du formulaire lors du clic sur le bouton
    btnChangeEtat.addEventListener('click', function() {
        if (formChangeEtat.style.display === 'none') {
            formChangeEtat.style.display = 'block';
        } else {
            formChangeEtat.style.display = 'none';
        }
    });
});

</script>

@endsection