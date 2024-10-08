<?php

namespace App\Livewire;

use Livewire\Component;

class UNSPSCSelect extends Component
{
    public $unspscs = [];
    public $unspsc;

    public function mount($unspsc){
        $this->unspsc = $unspsc;
    }
    public function render()
    {
        $this->unspscs = $this->unspsc;

        if(!empty($this->unspscs)){
            
        }
        return view('livewire.u-n-s-p-s-c-select');
    }
}
