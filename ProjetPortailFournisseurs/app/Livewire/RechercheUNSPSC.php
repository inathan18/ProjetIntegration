<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RechercheUNSPSC extends Component
{
    public $search = '';
    public $unspscs;

    public function updatedTerm(){

    }
    public function render()
    {
        $url = 'https://www.ungm.org/API/UNSPSCs';
        $json = file_get_contents($url);
        $json = json_decode($json, TRUE);
        Log::Debug($json);
        $unspscCollection = collect($json);
        Log::Debug($unspscCollection);

            $unspscs = $json->where('id', 'like', '%' . $this->search . '%')
            ->orWhere('Title', 'like', '%' . $this->search . '%')
            ->get();

        


        return view('livewire.recherche-u-n-s-p-s-c');
    }
}
