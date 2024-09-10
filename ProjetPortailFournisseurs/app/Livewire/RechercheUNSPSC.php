<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Fournisseurs;

class RechercheUNSPSC extends Component
{
    public $search = '';
    public function render()
    {
        return view('livewire.recherche-u-n-s-p-s-c');
    }
}
