@extends('layouts.app')

@section('titre', "Dossiers fournisseurs")

@section('contenu')

<div class="container mt-5">
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
                    
                    <!-- Dates de création et de dernière modification -->
                    <div class="d-flex justify-content-between">
                        <div>
                            <p>Dernière modification : <span>{{ date('d-m-y', strtotime($fournisseur->updated_at)) }}</span></p>
                        </div>
                    </div>

                    <a href="{{ route('fournisseurs.historique', $fournisseur->id) }}" class="text-primary">Historique</a>
                </div>
            </div>
        </div>



        <!-- Identification -->
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Identification</h5>
                    <p>{{ $fournisseur->neq }}</p>
                    <p>{{ $fournisseur->name }}</p>
                    <p>{{ $fournisseur->email }}</p>
                </div>
            </div>
        </div>

        <!-- Adresse -->
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Adresse</h5>
                    <p>{{ $fournisseur->address }}</p>
                    <p>{{ $fournisseur->city }}</p>
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

@endsection