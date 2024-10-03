<?php

namespace App\Livewire;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

use Livewire\Component;

class SupplierForm extends Component
{
    public $selected = '';
    //public $rbqs;
    public $neq;

    public function mount(/*$rbqs, */$neq){
        //$this->rbqs = $rbqs;
        $this->neq = $neq;
        Log::Debug($neq);

    }
    public function render()
    {
       // $this->selected = $this->rbqs[(int)($this->neq)-1];
       $this->selected = $this->neq;
       Log::Debug("NEQ");
        Log::Debug($this->neq);
        if(!empty($this->selected))
        {
           Log::Debug($this->selected);
            $name = $this->selected['Nom de l\'intervenant'];
            $address = Str::before($this->selected['Adresse'], strtoupper($this->selected['Municipalite']));
            $email = $this->selected['Courriel'];
            $status = $this->selected['Statut de la licence'];
            $rbq = $this->selected['Numero de licence'];
            $city = $this->selected['Municipalite'];
            $region = $this->selected['Region administrative']. ' ('.$this->selected['Code de region administrative'] . ')';
            $postCode = Str::after($this->selected['Adresse'], 'CANADA ');
            $website = "www." . Str::after($this->selected['Courriel'], '@');

            Log::Debug("Name");
            Log::Debug($name);

        }
        return view('livewire.supplier-form', compact('name', 'address', 'email', 'status'), compact('rbq', 'city', 'region', 'postCode', 'website'));
    }
}
