<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Fournisseur;

class RechercheFournisseurs extends Component
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

    public function render()
    {
        \Log::info('Render method called', ['filters' => $this->filtre]);
        $query = Fournisseur::query();
    
        $statuts = [];
        if ($this->filtre['attente']) $statuts[] = 'AT';
        if ($this->filtre['accepte']) $statuts[] = 'A';
        if ($this->filtre['refuse']) $statuts[] = 'R';
        if ($this->filtre['reviser']) $statuts[] = 'AR';
    
        if (!empty($statuts)) {
            $query->whereIn('statut', $statuts);
        }
        
        return view('GestionFournisseurs.index', [
            'fournisseurs' => $query->get(),
        ]);
    }
    
}
