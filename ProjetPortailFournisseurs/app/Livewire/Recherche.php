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
    public $toutesLesVilles = [];

    public function mount()
    {
        $this->chargerRegionsEtVilles();
        $this->recherche();
        $this->filtre['region'] = [];
        Log::info('Régions après chargement', ['regions' => $this->regions]);
        Log::info('Filtre avant chargement des villes', ['filtre' => $this->filtre['region']]);
    }

    public function updatedRechercheTerm()
    {
        $this->recherche();
    }

    public function recherche()
    {
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

        $this->fournisseurs = $query->get();
    }

    public function chargerRegionsEtVilles()
    {
        $cacheKey = 'regions_and_cities';
        $cacheTime = 60;
    
        // Utilisation de Cache pour récupérer les données
        $data = Cache::remember($cacheKey, $cacheTime, function () {
            $response = file_get_contents('https://www.donneesquebec.ca/recherche/api/3/action/datastore_search_sql?sql=SELECT%20munnom%2C%20regadm%20FROM%20%2219385b4e-5503-4330-9e59-f998f5918363%22');
            return json_decode($response, true);
        });
    
        $municipalitesDB = Cache::remember('municipalites_db', 60, function () {
            return Fournisseur::distinct()->pluck('city')->toArray();
        });
    
        $this->regions = [];
        $this->villes = [];
        $this->toutesLesVilles = [];
        $regionsTemp = [];
    
        $municipalitesSet = array_flip($municipalitesDB);
    
        foreach ($data['result']['records'] as $item) {
            if (in_array($item['munnom'], $municipalitesDB)) {
                $ville = [
                    'value' => $item['munnom'],
                    'region' => $item['regadm']
                ];
                $this->villes[] = $ville;
                $this->toutesLesVilles[] = $ville;  // Ajout ici
                $regionsTemp[$item['regadm']] = true;
            }
        }
    
        $this->regions = array_keys($regionsTemp);
    
        Log::info('Régions chargées', ['regions' => $this->regions]);
        Log::info('Villes chargées', ['villes' => $this->villes]);
        Log::info('Toutes les villes chargées', ['toutesLesVilles' => $this->toutesLesVilles]);
    
        // Tri des villes et des régions par numéro
        $this->villes = $this->sortByRegionNumber($this->villes);
        $this->toutesLesVilles = $this->sortByRegionNumber($this->toutesLesVilles);
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

    public function chargerVilles()
    {
        Log::info('Régions sélectionnées pour le filtrage', ['regions' => $this->filtre['region']]);
        Log::info('Toutes les villes disponibles', ['villes' => $this->toutesLesVilles]);

        if (empty($this->filtre['region'])) {
            $this->villes = $this->toutesLesVilles;
        } else {
            $this->villes = collect($this->toutesLesVilles)->filter(function ($ville) {
                return in_array($ville['region'], $this->filtre['region']);
            })->values()->toArray();
        }

        Log::info('Villes après filtrage', ['villes' => $this->villes]);

        $this->dispatch('villes-chargées');
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
