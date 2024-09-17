<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Unspsc;
use Cerbero\LazyJson\LazyJson;
use Illuminate\Support\LazyCollection;

use function Cerbero\LazyJson\lazyJson;

class RechercheUNSPSC extends Component
{
    public $search = 'Ruxolitinib';
    public $unspscs;

    public function updatedTerm(){

    }
    public function render()
    {
        $url = 'https://www.ungm.org/API/UNSPSCs';
        $json = file_get_contents($url);
        $jsons = json_decode($json, TRUE);
        $search = 'Ruxolitinib';
        $unspscCollection= LazyCollection::fromJson($json, "value.*")->toArray();
        ;
        //Log::Debug($json);
        //$unspscCollection = collect($jsons);


        /*foreach ($jsons as $json){
            $json = new Unspsc();
            $json->Id = $json['Id'];
            $json->ParentId = $json['ParentId'];
            $json->UNSPSCode = $json['UNSPSCode'];
            $json->Title = $json['Title'];
            $json->save();
        }*/
        //Log::Debug($json);
        //$unspscCollection = Unspsc::hydrate($json);
       // $unspscCollection = $unspscCollection->flatten();
       //$unspscCollection = collect($json);
        //Log::Debug($unspscCollection);


           /* $unspscs = $unspscCollection->where('Id', 'like', '%' . $this->search . '%')
            //->orWhere('Title', 'like', '%' . $this->search . '%')
            ->get(10);*/


                Log::Debug($unspscCollection->where('Title','Ruxolitinib'));


        return view('livewire.recherche-u-n-s-p-s-c', [
            'unspscs' => $unspscCollection
        ]);
    }
}
