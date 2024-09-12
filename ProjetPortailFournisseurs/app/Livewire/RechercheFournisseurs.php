<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Supplier;

class SupplierList extends Component
{
    public $filter = [
        'attente' => false,
        'accepte' => false,
        'refuse' => false, 
        'reviser' => false,
        'service' => '',
        'categorie' => '',
        'region' => [],
        'ville' => []
    ];
    public $fournisseursSelectionnes = [];

    public function recherche()
    {
        
    }

    public function exporterSelection()
    {
        
    }

    public function render()
    {
        $fournisseurs = Fournisseur::query();

        if ($this->filter['AT']) {
            $fournisseurs->where('statut', 'AT');
        }
        if ($this->filter['A']) {
            $fournisseurs->where('statut', 'A');
        }
        if ($this->filter['R']) {
            $fournisseurs->where('statut', 'R');
        }
        if ($this->filter['RE']) {
            $fournisseurs->where('statut', 'RE');
        }

        return view('GestionFournisseurs.index', ['fournisseurs' => $fournisseurs->get()]);
    }
}
