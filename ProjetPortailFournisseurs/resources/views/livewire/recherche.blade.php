<div class="container mt-5">
    <div class="card mb-4">
        <div class="card-header">
            <strong>Rechercher et Filtrer</strong>
        </div>
        <div class="card-body">
            <div class="row mb-3 align-items-center">
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

        <div class="row mb-3">
            <div class="col-12 col-md-6 col-lg-3 mb-2">
                <select id="produitsServices" class="selectpicker" multiple wire:model="filtre.service" data-live-search="true" title="Produits et Services" data-selected-text-format="static">
                    <option value="pelouse">Pelouse</option>
                    <option value="rouleuses">Rouleuses pour pelouses</option>
                    <option value="scarificateur">Scarificateur de pelouse</option>
                </select>
            </div>

            <div class="col-12 col-md-6 col-lg-3 mb-2">
                <select id="categoriesTravaux" class="selectpicker" multiple wire:model="filtre.categorie" data-live-search="true" title="Catégories de Travaux" data-selected-text-format="static">
                    <option value="general">Entrepreneur général</option>
                    <option value="specialise">Entrepreneur spécialisé</option>
                </select>
            </div>

            <div class="col-12 col-md-6 col-lg-3 mb-2">
                <select id="regions" class="selectpicker" multiple wire:model="filtre.region" data-live-search="true" title="Régions administratives" data-selected-text-format="static">
                    @foreach($regions as $region)
                        <option value="{{ $region }}">{{ $region }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-12 col-md-6 col-lg-3 mb-2">
                <select id="villes" class="selectpicker" multiple wire:model="filtre.ville" data-live-search="true" title="Villes" data-selected-text-format="static">
                    @foreach($villes as $ville)
                        <option value="{{ $ville['value'] }}">{{ $ville['value'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <strong>Liste des Fournisseurs</strong>
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
                            <span class="text-{{ $fournisseur->statut == 'AT' ? 'warning' : ($fournisseur->statut == 'A' ? 'success' : ($fournisseur->statut == 'R' ? 'danger' : 'secondary')) }}">
                                @if ($fournisseur->statut == 'AT')
                                    <i class="fas fa-hourglass-half"></i>
                                @elseif ($fournisseur->statut == 'A')
                                    <i class="fas fa-check-circle"></i>
                                @elseif ($fournisseur->statut == 'R')
                                    <i class="fas fa-times-circle"></i>
                                @else
                                    <i class="fas fa-info-circle"></i>
                                @endif
                            </span>
                        </td>

                        <td>{{ $fournisseur->name }}</td>
                        <td>{{ $fournisseur->city }}</td>
                        <td></td>
                        <td></td>
                        <td>
                            <a href="" class="btn btn-secondary btn-sm">Ouvrir</a>
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
    <div class="text-end mt-3">
        <button class="btn btn-success" wire:click="ExporterSelection">Liste des fournisseurs sélectionnés</button>
    </div>
</div>

@section('scripts')

<script>
Livewire.hook('message.processed', () => {
    $('.selectpicker').selectpicker('refresh');
});
</script>


@endsection