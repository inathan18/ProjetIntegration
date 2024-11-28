<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Fournisseur;
use Illuminate\Support\Facades\Cache;
use Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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
        'ville' => [],
        'produitsServices' => [],
    ];

    public $rechercheTerm = '';
    public $FournisseursSelectionnes = [];
    public $fournisseurs = [];
    public $regions = [];
    public $villes = [];
    public $toutesLesVilles = [];
    public $unspscDescriptions = [];
    public $codesUnspsc = [];

    public function mount()
    {
        $this->chargerProduitsServices();
        $this->chargerRegionsEtVilles();
        $this->recherche();
        $this->filtre['region'] = [];
    }

    public function updatedRechercheTerm()
    {
        $this->recherche();
    }

    public function chargerProduitsFiltres()
    {
        if (empty($this->filtre['produitsServices'])) {
            $this->dispatch('produits-services-reset');
        }
    
        $this->recherche();
    }
    

    public function chargerProduitsServices()
    {
        // Chargement des produits et services depuis le fichier JSON
        $unspscData = json_decode(file_get_contents(public_path('unspsc.json')), true);
    
        // Récupération des descriptions UNSPSC
        $unspscDataMap = collect($unspscData)->keyBy('codeUnspsc');
        
        // Récupération des codes UNSPSC distincts dans la base de données
        $fournisseursUnspsc = DB::table('fournisseurs')
            ->whereNotNull('unspsc')
            ->pluck('unspsc')
            ->toArray();
        
        $this->codesUnspsc = collect($fournisseursUnspsc)
            ->flatMap(function ($unspsc) {
                return json_decode($unspsc, true);
            })
            ->unique()
            ->values()
            ->toArray();
    
        // Ne garder que les descriptions des codes UNSPSC présents en base de données
        $this->unspscDescriptions = collect($this->codesUnspsc)
            ->mapWithKeys(function ($code) use ($unspscDataMap) {
                return $unspscDataMap->has($code) 
                    ? [$code => $unspscDataMap[$code]['descUnspsc']]
                    : [];
            })
            ->toArray();
    }

    public function recherche()
    {
        $query = Fournisseur::query();

        // Filtres de statut
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

        $villesAutorisees = collect($this->toutesLesVilles);

        // Filtre par région
        if (!empty($this->filtre['region'])) {
            $villesAutorisees = $villesAutorisees->filter(function ($ville) {
                return in_array($ville['region'], $this->filtre['region']);
            });
        }
        
        // Filtre par villes spécifiques si sélectionnées
        if (!empty($this->filtre['ville'])) {
            $villesFinales = $this->filtre['ville'];
        } else {
            $villesFinales = $villesAutorisees->pluck('value')->unique()->values()->toArray();
        }

        if (!empty($villesFinales)) {
            $query->whereIn('city', $villesFinales);
        }

        // Filtres UNSPSC
        // Produits et Services filtering
    $selectedServices = $this->filtre['produitsServices'] ?? [];

    if (!empty($selectedServices)) {
        $query->where(function ($subQuery) use ($selectedServices) {
            $subQuery->whereNull('unspsc')
                ->orWhere(function ($q) use ($selectedServices) {
                    $q->where(function ($innerQ) use ($selectedServices) {
                        foreach ($selectedServices as $code) {
                            $innerQ->orWhereJsonContains('unspsc', $code);
                        }
                    });
                });
        });
    }
    // Executer la recherche
    $this->fournisseurs = $query->get()->map(function ($fournisseur) use ($selectedServices) {
        $fournisseurUnspsc = is_array($fournisseur->unspsc) 
            ? $fournisseur->unspsc 
            : (json_decode($fournisseur->unspsc, true) ?? []);
        
        $correspondingServices = $selectedServices 
            ? array_intersect($fournisseurUnspsc, $selectedServices) 
            : [];
        
        $fournisseur->correspondingServicesCount = count($correspondingServices);
        $fournisseur->correspondingServicesTotal = count($selectedServices);
        
        return $fournisseur;
    });
    
        $this->fournisseurs = $query->get()->map(function ($fournisseur) use ($selectedServices) {
            $fournisseurUnspsc = is_array($fournisseur->unspsc) 
                ? $fournisseur->unspsc 
                : (json_decode($fournisseur->unspsc, true) ?? []);
            
            $correspondingServices = array_intersect($fournisseurUnspsc, $selectedServices);
            
            $fournisseur->correspondingServicesCount = count($correspondingServices);
            $fournisseur->correspondingServicesTotal = count($selectedServices);
            
            return $fournisseur;
        });
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
                $this->toutesLesVilles[] = $ville; 
                $regionsTemp[$item['regadm']] = true;
            }
        }
    
        $this->regions = array_keys($regionsTemp);

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
        if (empty($this->filtre['region'])) {
            $this->villes = $this->toutesLesVilles;
        } else {
            $this->villes = collect($this->toutesLesVilles)
                ->filter(function ($ville) {
                    return in_array($ville['region'], $this->filtre['region']);
                })
                ->values()
                ->toArray();
        }

        $villesDisponibles = collect($this->villes)->pluck('value')->toArray();
        $this->filtre['ville'] = array_values(array_intersect($this->filtre['ville'], $villesDisponibles));
        
        $this->dispatch('villes-chargées');
        $this->recherche();
    }

    public function chargerToutesLesVilles()
    {
        $this->villes = $this->toutesLesVilles;
        $this->dispatch('villes-chargées');
    }
    

    public function resetFiltres()
    {
        // Réinitialise les filtres
        $this->filtre = [
            'attente' => false,
            'accepte' => false,
            'refuse' => false,
            'reviser' => false,
            'service' => [],
            'categorie' => [],
            'region' => [],
            'ville' => [],
            'produitsServices' => [],
        ];

        $this->rechercheTerm = '';
        $this->recherche();
        $this->dispatch('resetSelects');
    }
    
    public function ExporterSelection()
    {
        if (empty($this->FournisseursSelectionnes)) {
            session()->flash('message', 'Veuillez sélectionner au moins un fournisseur.');
            return;
        }
        session()->put('selected_fournisseurs', $this->FournisseursSelectionnes);
        
        return redirect()->route('fournisseurs.selectionnes');
    }
    public function render()
    {
        return view('livewire.recherche', [
            'fournisseurs' => $this->fournisseurs,
        ]);
    }
}
