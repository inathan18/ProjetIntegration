<?php

namespace App\Livewire;

use Livewire\Component;

class SupplierForm extends Component
{
    public $selected = '';
    public $rbqs;

    public function mount($rbqs){
        $this->rbqs = $rbqs;
    }
    public function render()
    {
        if(!empty($this->selected))
        {
            $selected1 = $rbqs[$selected-1];
            $name = $selected1['Nom de l\'intervenant'];

        }
        return view('livewire.supplier-form', compact('name'));
    }
}
