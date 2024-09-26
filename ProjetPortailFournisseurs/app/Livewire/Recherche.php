<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Fournisseur;
use Illuminate\Support\Facades\Cache;
use Log;

class Recherche extends Component
{
    public $filtre = [
        'attente' => false,
        'accepte' => false,
        'refuse' => false,
        'reviser' => false,
        'service' => [],
        'categorie' => [],
        'region' => [],
        'ville' => []
    ];

    public $rechercheTerm = '';
    public $FournisseursSelectionnes = [];
    public $fournisseurs = [];
    public $regions = [];
    public $villes = [];

    public function mount()
    {
        $this->recherche();
        $this->chargerRegionsEtVilles();
    }

    public function updatedRechercheTerm()
    {
        $this->recherche();
    }

    public function recherche()
    {
        Log::info('Recherche en cours', ['filters' => $this->filtre, 'recherche' => $this->rechercheTerm]);

        $query = Fournisseur::query();

        // Cases à cocher
        $statuts = [];
        if ($this->filtre['attente']) $statuts[] = 'AT';
        if ($this->filtre['accepte']) $statuts[] = 'A';
        if ($this->filtre['refuse']) $statuts[] = 'R';
        if ($this->filtre['reviser']) $statuts[] = 'AR';

        if (!empty($statuts)) {
            $query->whereIn('statut', $statuts);
        }

        // Champ de recherche
        if (!empty($this->rechercheTerm)) {
            $query->where('name', 'like', '%' . $this->rechercheTerm . '%');
        }

        // Filtres supplémentaires
        /*
        if (!empty($this->filtre['service'])) {
            $query->whereIn('service', $this->filtre['service']);
        }
        if (!empty($this->filtre['categorie'])) {
            $query->whereIn('categorie', $this->filtre['categorie']);
        }
        if (!empty($this->filtre['region'])) {
            $query->whereIn('region', $this->filtre['region']);
        }
        if (!empty($this->filtre['ville'])) {
            $query->whereIn('ville', $this->filtre['ville']);
        }
        */

        $this->fournisseurs = $query->get();
    }

    public function chargerRegionsEtVilles()
    {
        $cacheKey = 'regions_and_cities';
        $cacheTime = 60;

        // Utilisation de Cache pour récupérer les données
        $data = Cache::remember($cacheKey, $cacheTime, function () {
            // Faire l'appel à l'API si les données ne sont pas en cache
            $response = file_get_contents('https://www.donneesquebec.ca/recherche/api/3/action/datastore_search_sql?sql=SELECT%20munnom%2C%20regadm%20FROM%20%2219385b4e-5503-4330-9e59-f998f5918363%22');
            return json_decode($response, true);
        });
        $municipalitesDB = Cache::remember('municipalites_db', 60, function () {
            return Fournisseur::distinct()->pluck('city')->toArray();
        });

        $this->regions = [];
        $this->villes = [];
        $regionsTemp = [];

        $municipalitesSet = array_flip($municipalitesDB);

        foreach ($data['result']['records'] as $item) {
            // Ajouter la ville si elle est dans la base de données
            if (isset($municipalitesSet[$item['munnom']])) {
                $this->villes[] = [
                    'value' => $item['munnom'],
                    'region' => $item['regadm']
                ];
                $regionsTemp[$item['regadm']] = true;
            }
        }

        $this->regions = array_keys($regionsTemp);

        // Tri des villes et des régions par numéro
        $this->villes = $this->sortByRegionNumber($this->villes);
        $this->regions = $this->sortByRegionNumber($this->regions);
    }

    private function sortByRegionNumber($array)
    {
        usort($array, function($a, $b) {
            $numA = intval(substr($a['region'] ?? $a, strrpos($a['region'] ?? $a, '(') + 1, 2));
            $numB = intval(substr($b['region'] ?? $b, strrpos($b['region'] ?? $b, '(') + 1, 2));
            return $numA <=> $numB;
        });
        return $array;
    }


    public function ExporterSelection()
    {
        Log::info('Exportation des fournisseurs sélectionnés', ['selection' => $this->FournisseursSelectionnes]);
    }

    public function render()
    {
        return view('livewire.recherche', [
            'fournisseurs' => $this->fournisseurs,
        ]);
    }
}
