<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Fournisseur;
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

    public function rechercherFournisseurs()
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

        // Filtres
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

    public function ExporterSelection()
    {
        Log::info('Exportation des fournisseurs sélectionnés', ['selection' => $this->FournisseursSelectionnes]);
    }

    public function mount()
    {
        $this->rechercherFournisseurs(); // Charger les fournisseurs initiaux
    }

    public function render()
    {
        return view('livewire.recherche', [
            'fournisseurs' => $this->fournisseurs, 
        ]);
    }
}
