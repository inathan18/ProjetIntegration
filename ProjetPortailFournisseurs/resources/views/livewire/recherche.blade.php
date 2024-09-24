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
                                <input type="checkbox" class="form-check-input" wire:model="filtre.attente" wire:change="rechercherFournisseurs"> En attente
                            </label>
                        </div>
                        <div class="me-2">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" wire:model="filtre.accepte" wire:change="rechercherFournisseurs"> Acceptées
                            </label>
                        </div>
                        <div class="me-2">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" wire:model="filtre.refuse" wire:change="rechercherFournisseurs"> Refusées
                            </label>
                        </div>
                        <div class="me-2">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" wire:model="filtre.reviser" wire:change="rechercherFournisseurs"> À réviser
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4 mb-2">
                    <div class="d-flex align-items-center">
                        <div class="position-relative flex-grow-1">
                            <input type="text" class="form-control pe-5" placeholder="Recherche" wire:model="rechercheTerm">
                            <i class="bi bi-search position-absolute top-50 end-0 translate-middle-y me-2"></i>
                        </div>
                        <button class="btn btn-primary ms-2" wire:click="recherche">Rechercher</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12 col-md-6 col-lg-3 mb-2" wire:ignore>
                <select id="produitsServices" class="selectpicker" multiple wire:model="filtre.service" data-live-search="true">
                    <option value="pelouse">Pelouse</option>
                    <option value="rouleuses">Rouleuses pour pelouses</option>
                    <option value="scarificateur">Scarificateur de pelouse</option>
                </select>
            </div>

            <div class="col-12 col-md-6 col-lg-3 mb-2" wire:ignore>
                <select id="categoriesTravaux" class="selectpicker" multiple wire:model="filtre.categorie" data-live-search="true">
                    <option value="general">Entrepreneur général</option>
                    <option value="specialise">Entrepreneur spécialisé</option>
                </select>
            </div>

            <div class="col-12 col-md-6 col-lg-3 mb-2" wire:ignore>
                <select id="regions" class="selectpicker" multiple wire:model="filtre.region" data-live-search="true">
                    <option value="01">Bas-Saint-Laurent</option>
                    <option value="02">Saguenay-Lac-Saint-Jean</option>
                    <option value="03">Capitale-Nationale</option>
                    <option value="04">Mauricie</option>
                    <option value="05">Estrie</option>
                </select>
            </div>

            <div class="col-12 col-md-6 col-lg-3 mb-2" wire:ignore>
                <select id="villes" class="selectpicker" multiple wire:model="filtre.ville" data-live-search="true">
                    <option value="Batiscan">Batiscan</option>
                    <option value="Beaupre">Beaupré</option>
                    <option value="Boischatel">Boischatel</option>
                    <option value="Cap-Sante">Cap-Santé</option>
                    <option value="Champlain">Champlain</option>
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
                        <td>Produit</td>
                        <td>Catégorie</td>
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


</script>

@endsection