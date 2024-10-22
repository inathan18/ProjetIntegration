<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Unspsc;
use Cerbero\LazyJson\LazyJson;
use Illuminate\Support\LazyCollection;
use Illuminate\Validation\Rule;
use Knackline\ExcelTo\ExcelTo;
use ZipArchive;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\State;
use Livewire\Attributes\Url;

use function Cerbero\LazyJson\lazyJson;

class RechercheUNSPSC extends Component
{
    public $search = '';
    public $unspscs;
    public $selectedUnspscs = [];

    public function updatedTerm(){

    }

    public function hydrate(){
        $this->dispatch('select2Hydrate');
    }
    public function render()
    {
        $url = 'https://www.ungm.org/API/UNSPSCs';
        $options = array('http' => array('Accept-language: fr\r\n'));
        $context = stream_context_create($options);
        $jsonPath = public_path('unspsc.json');
        $json = file_get_contents($jsonPath, false, $context);
        $jsons = json_decode($json, TRUE);
        
        $unspscCollections= collect(LazyCollection::fromJson($json, "*")->toArray());
        //Log::Debug($json);

        //$unspscCollections= collect(LazyCollection::fromJson($json, "value.*")->toArray());


        
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


                /*Log::Debug($unspscCollections->where('descUnspsc','Ruxolitinib'));
                Log::Debug($unspscCollections->filter(function($unspscCollection){
                    return str_contains($unspscCollection['descUnspsc'], 'police');
                }));*/
            if(!empty($this->search)){
                $unspscs = $unspscCollections->filter(function($unspscCollection){
                    return str_contains($unspscCollection['descUnspsc'], $this->search);
                })->all();
            }
                else {
                    $unspscs = NULL;
                }
            

                Log::Debug($unspscs);
                $tests = $unspscs;


        return view('livewire.recherche-u-n-s-p-s-c', compact('tests'));

    }


}
