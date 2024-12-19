<div class="container">
@include('layouts.navbarResponsable')
@if (session()->has('message'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Filtres -->
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <strong>Rechercher et Filtrer</strong>
            <button class="btn btn-secondary ms-auto" wire:click="resetFiltres">Réinitialiser les filtres</button>
        </div>

        <!-- Cases à cocher statut demande-->
        <div class="card-body">
            <div class="row mb-3 align-items-center">
                @if(in_array(auth()->guard('usager')->user()->role, ['responsable', 'administrateur']))
                    <div class="col-12 col-md-8 mb-2">
                        <div class="d-flex flex-wrap align-items-center">
                            <div class="me-2">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" wire:model="filtre.attente" wire:change="recherche"> En attente
                                </label>
                            </div>
                            <div class="me-2">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" wire:model="filtre.accepte" wire:change="recherche"> Acceptées
                                </label>
                            </div>
                            <div class="me-2">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" wire:model="filtre.refuse" wire:change="recherche"> Refusées
                                </label>
                            </div>
                            <div class="me-2">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" wire:model="filtre.reviser" wire:change="recherche"> À réviser
                                </label>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Bouton rechercher -->
                <div class="col-12 col-md-4 mb-2">
                    <div class="d-flex align-items-center">
                        <div class="position-relative flex-grow-1">
                            <input type="text" class="form-control pe-5" placeholder="Recherche" wire:model.live.debounce.500ms="rechercheTerm">
                            <i class="bi bi-search position-absolute top-50 end-0 translate-middle-y me-2"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Select -->
        <div class="row mb-3" wire:ignore>
            <div class="col-12 col-md-6 col-lg-3 mb-2">
                <!-- Produits et services -->
                <select id="produitsServices" wire:model="filtre.produitsServices" wire:change="chargerProduitsFiltres" class="selectpicker"
                    multiple data-live-search="true" title="Produits et services">
                    @foreach($unspscDescriptions as $code => $description)
                        <option value="{{ $code }}">{{ $description }}</option>
                    @endforeach
                </select>
            </div>
            <!-- Catégories de travaux -->
            <div class="col-12 col-md-6 col-lg-3 mb-2">
                <select id="categoriesTravaux" class="selectpicker" multiple wire:model="filtre.categorie" data-live-search="true"
                    title="Catégories de Travaux" data-selected-text-format="static">
                    @foreach($categoriesTravauxDescriptions as $code => $description)
                        <option value="{{ $code }}">{{ $description }}</option>
                    @endforeach
                </select>
            </div>
            <!-- Régions administratives -->
            <div class="col-12 col-md-6 col-lg-3 mb-2">
                <select id="regions" class="selectpicker" multiple wire:model="filtre.region" data-live-search="true"
                 title="Régions administratives" data-selected-text-format="static" wire:change="chargerVilles">
                    @foreach($regions as $region)
                        <option value="{{ $region }}">{{ $region }}</option>
                    @endforeach
                </select>
            </div>
            <!-- Villes -->
            <div class="col-12 col-md-6 col-lg-3 mb-2">
                <select id="villes" class="selectpicker" multiple wire:model.live="filtre.ville" data-live-search="true"
                 title="Villes" data-selected-text-format="static" wire:change="recherche">
                    @foreach($villes as $ville)
                        <option value="{{ $ville['value'] }}">{{ $ville['value'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <!-- Liste des fournisseurs -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <strong>Liste des Fournisseurs</strong>
            <button class="btn btn-secondary ms-auto" wire:click="ExporterSelection">Liste des fournisseurs sélectionnés</button>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>État</th>
                        <th>Fournisseur</th>
                        <th>Ville</th>
                        <th>Produits et services</th>
                        <th>Catégories de travaux</th>
                        <th>Fiche fournisseur</th>
                        <th>Sélectionner</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($fournisseurs as $fournisseur)
                    <tr>
                    <td>
                        <span class="text-{{ 
                            $fournisseur->statut == 'AT' ? 'warning' : 
                            ($fournisseur->statut == 'A' ? 'success' : 
                            ($fournisseur->statut == 'R' ? 'danger' : 
                            ($fournisseur->statut == 'D' ? 'muted' : 'secondary'))) }}">
                            @if ($fournisseur->statut == 'AT')
                                <i class="fas fa-hourglass-half"></i>
                            @elseif ($fournisseur->statut == 'A')
                                <i class="fas fa-check-circle"></i>
                            @elseif ($fournisseur->statut == 'R')
                                <i class="fas fa-times-circle"></i>
                            @elseif ($fournisseur->statut == 'D')
                                <i class="fas fa-ban"></i>
                            @else
                                <i class="fas fa-info-circle"></i>
                            @endif
                        </span>
                    </td>


                        <td>{{ $fournisseur->name }}</td>
                        <td>{{ $fournisseur->city }}</td>
                        <td>
                            @if (isset($fournisseur->correspondingServicesCount))
                                {{ $fournisseur->correspondingServicesCount }}/{{ $fournisseur->correspondingServicesTotal }}
                            @else
                                0/{{ $fournisseur->correspondingServicesTotal ?? 0 }}
                            @endif
                        </td>
                        <td>
                            @if (isset($fournisseur->correspondingCategoriesCount))
                                {{ $fournisseur->correspondingCategoriesCount }}/{{ $fournisseur->correspondingCategoriesTotal }}
                            @else
                                0/{{ $fournisseur->correspondingCategoriesTotal ?? 0 }}
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('fournisseurs.showFiche', $fournisseur->id) }}" class="btn btn-primary btn-sm">Ouvrir</a>
                        </td>
                        <td>
                            <input type="checkbox" wire:model="FournisseursSelectionnes" value="{{ $fournisseur->id }}">
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@section('scripts')
<script>
$(document).ready(function() {
    $('.selectpicker').selectpicker();

    // Gestion des produits et services
    $('#produitsServices').on('changed.bs.select', function () {
        let selectedProduitsServices = $(this).val() || [];
        @this.set('filtre.produitsServices', selectedProduitsServices);
        @this.call('chargerProduitsFiltres');
    });

    Livewire.on('produits-services-charges', () => {
        $('.selectpicker').selectpicker('refresh');
    });


    // Gestion des catégories de travaux
    $('#categoriesTravaux').on('changed.bs.select', function () {
        let selectedCategories = $(this).val() || [];
        @this.set('filtre.categorie', selectedCategories);
        @this.call('chargerCategoriesTravauxFiltres');
    });

    Livewire.on('categories-travaux-charges', () => {
        $('.selectpicker').selectpicker('refresh');
    });

    // Gestion du changement de région
    $('#regions').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
        let selectedRegions = $(this).val() || [];
        
        @this.set('filtre.region', selectedRegions);
        @this.chargerVilles();
    });

    // Gestion du changement de ville
    $('#villes').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
        let selectedVilles = $(this).val() || [];
        @this.set('filtre.ville', selectedVilles);
        @this.recherche();
    });

    Livewire.on('villes-chargées', () => {
        let selectElement = $('#villes');
        selectElement.empty();

        @this.villes.forEach(ville => {
            selectElement.append(new Option(ville.value, ville.value));
        });
        
        selectElement.val(@this.filtre.ville);
        
        selectElement.selectpicker('destroy');
        selectElement.selectpicker('render');
        selectElement.selectpicker('refresh');
    });

    Livewire.on('produits-services-reset', () => {
        $('#produitsServices')
            .selectpicker('deselectAll')
            .selectpicker('refresh');
    });

    // Bouton reset
    Livewire.on('resetSelects', () => {
        $('.selectpicker').selectpicker('deselectAll');
        $('.selectpicker').selectpicker('refresh');
        
        @this.chargerToutesLesVilles();
        
        $('.selectpicker').selectpicker('refresh');
    });
});
</script>
@endsection