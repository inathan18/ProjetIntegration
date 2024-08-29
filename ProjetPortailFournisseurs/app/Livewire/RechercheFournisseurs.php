<?php

namespace App\Livewire;

use Livewire\Component;

class RechercheFournisseurs extends Component
{
    public $search = '';
    public function render()
    {
        $fournisseurs = Fournisseur::where('name', 'like', '%' . $this->search . '%')
                                ->orWhere('email', 'like', '%' . $this->search . '%')
                                ->orWhere('neq', 'like', '%' . $this->search . '%')
                                ->get();
        return view('livewire.recherche-fournisseurs', ['fournisseurs' => $fournisseurs]);
    }
}
