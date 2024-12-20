<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Fournisseur;
use Illuminate\Support\Facades\Cache;
use Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Request;
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
    public $categoriesTravauxDescriptions = [];
    public $codesCategoriesTravaux = [];

    public function mount()
    {
        // Si l'utilisateur n'est pas responsable ou administrateur, cocher "Acceptées" par défaut
        if (!in_array(auth()->guard('usager')->user()->role, ['responsable', 'administrateur'])) {
            $this->filtre['accepte'] = 1; 
        }
        $this->chargerProduitsServices();
        $this->chargerCategoriesTravaux();
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

    public function chargerCategoriesTravaux()
    {
        // Chargement des catégories de travaux depuis le fichier JSON
        $categoriesData = json_decode(file_get_contents(public_path('typesrbq.json')), true);

        // Récupération des descriptions des catégories de travaux
        $categoriesDataMap = collect($categoriesData)->keyBy('codeRbq');

        // Récupération des codes des catégories de travaux distincts dans la base de données
        $fournisseursCategories = DB::table('fournisseurs')
            ->whereNotNull('typesRbq')
            ->pluck('typesRbq')
            ->toArray();

        $this->codesCategoriesTravaux = collect($fournisseursCategories)
            ->flatMap(function ($typeRbq) {
                return json_decode($typeRbq, true);
            })
            ->unique()
            ->values()
            ->toArray();

        // Ne garder que les descriptions des codes catégories de travaux présents en base de données
        $this->categoriesTravauxDescriptions = collect($this->codesCategoriesTravaux)
            ->mapWithKeys(function ($code) use ($categoriesDataMap) {
                return $categoriesDataMap->has($code) 
                    ? [$code => $categoriesDataMap[$code]['nomRbq']] 
                    : [];
            })
            ->toArray();
    }

    public function chargerCategoriesTravauxFiltres()
    {
        if (empty($this->filtre['categorie'])) {
            $this->dispatch('categories-travaux-reset');
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

        // Filtres de catégories de travaux
        if (!empty($this->filtre['categorie'])) {
            $query->where(function ($subQuery) {
                foreach ($this->filtre['categorie'] as $categorieCode) {
                    $subQuery->orWhereJsonContains('typesRbq', $categorieCode);
                }
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

            $selectedCategories = $this->filtre['categorie'] ?? [];
            $fournisseurCategories = is_array($fournisseur->typesRbq) 
                ? $fournisseur->typesRbq 
                : (json_decode($fournisseur->typesRbq, true) ?? []);
            $correspondingCategories = $selectedCategories 
                ? array_intersect($fournisseurCategories, $selectedCategories) 
                : [];
            $fournisseur->correspondingCategoriesCount = count($correspondingCategories);
            $fournisseur->correspondingCategoriesTotal = count($selectedCategories);
                        
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

    public function exportFournisseursToCsv()
    {
        try {
            return response()->streamDownload(function() {
                // En-têtes du CSV
                echo "\xEF\xBB\xBF";  // Pour l'encodage UTF-8 avec BOM
                $headers = [
                    'Nom',
                    'Adresse',
                    'Ville',
                    'Province',
                    'Région',
                    'Pays',
                    'Téléphone',
                    'Code postal',
                    'UNSPSC',
                    'Site web',
                    'Email',
                    'NEQ',
                    'RBQ',
                    'Types RBQ',
                    'Personne de contact',
                    'Statut'
                ];
                
                // Ouvrir le fichier en mémoire pour l'écriture
                $output = fopen('php://output', 'w');
                fputcsv($output, $headers, ';'); // Utilisation du délimiteur ';'

                // Appliquer les filtres
                $query = Fournisseur::query();
                
                $statuts = [];
                if ($this->filtre['attente']) $statuts[] = 'AT';
                if ($this->filtre['accepte']) $statuts[] = 'A';
                if ($this->filtre['refuse']) $statuts[] = 'R';
                if ($this->filtre['reviser']) $statuts[] = 'AR';

                if (!empty($statuts)) {
                    $query->whereIn('statut', $statuts);
                }

                if (!empty($this->rechercheTerm)) {
                    $query->where('name', 'like', '%' . $this->rechercheTerm . '%');
                }

                if (!empty($this->filtre['ville'])) {
                    $query->whereIn('city', $this->filtre['ville']);
                } elseif (!empty($this->filtre['region'])) {
                    $villesAutorisees = collect($this->toutesLesVilles)
                        ->filter(function ($ville) {
                            return in_array($ville['region'], $this->filtre['region']);
                        })
                        ->pluck('value')
                        ->toArray();
                    $query->whereIn('city', $villesAutorisees);
                }

                if (!empty($this->filtre['produitsServices'])) {
                    $query->where(function ($subQuery) {
                        foreach ($this->filtre['produitsServices'] as $code) {
                            $subQuery->orWhereJsonContains('unspsc', $code);
                        }
                    });
                }

                if (!empty($this->filtre['categorie'])) {
                    $query->where(function ($subQuery) {
                        foreach ($this->filtre['categorie'] as $categorieCode) {
                            $subQuery->orWhereJsonContains('typesRbq', $categorieCode);
                        }
                    });
                }

                // Récupérer les fournisseurs filtrés
                $fournisseurs = $query->get();

                // Parcourir chaque fournisseur et ajouter les lignes au CSV
                foreach ($fournisseurs as $fournisseur) {
                    $unspsc = is_string($fournisseur->unspsc) ? json_decode($fournisseur->unspsc, true) : $fournisseur->unspsc;
                    $typesRbq = is_string($fournisseur->typesRbq) ? json_decode($fournisseur->typesRbq, true) : $fournisseur->typesRbq;
                    $phone = is_string($fournisseur->phone) ? json_decode($fournisseur->phone, true) : $fournisseur->phone;
                    $contact = is_string($fournisseur->personneContact) ? json_decode($fournisseur->personneContact, true) : $fournisseur->personneContact;

                    // Ajouter chaque fournisseur au CSV
                    fputcsv($output, [
                        $fournisseur->name,
                        $fournisseur->address,
                        $fournisseur->city,
                        $fournisseur->province,
                        $fournisseur->region,
                        $fournisseur->country,
                        is_array($phone) ? implode(', ', $phone) : $phone,
                        $fournisseur->postCode,
                        is_array($unspsc) ? implode(', ', $unspsc) : $unspsc,
                        $fournisseur->website,
                        $fournisseur->email,
                        $fournisseur->neq,
                        $fournisseur->rbq,
                        is_array($typesRbq) ? implode(', ', $typesRbq) : $typesRbq,
                        is_array($contact) ? implode(', ', $contact) : $contact,
                        $fournisseur->statut
                    ], ';');
                }

                fclose($output);

            }, 'fournisseurs_' . date('Y-m-d_H-i-s') . '.csv', [
                'Content-Type' => 'text/csv; charset=UTF-8',
                'Content-Disposition' => 'attachment'
            ]);
            
        } catch (\Exception $e) {
            Log::error('CSV Export Error: ' . $e->getMessage());
            session()->flash('error', 'Une erreur est survenue lors de l\'exportation.');
            return null;
        }
    }

}