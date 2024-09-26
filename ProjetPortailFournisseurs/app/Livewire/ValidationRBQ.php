<?php

namespace App\Livewire;

use Livewire\Component;
use Cerbero\LazyJson\LazyJson;
use Illuminate\Support\LazyCollection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class ValidationRBQ extends Component
{

    public $search = '';
    public $rbq;

    public function render()
    {


        //$result = $url->getBody()->getContents();
       // Log::Debug($result->result->records);

        if(!empty($this->search)){
            $url = 'https://www.donneesquebec.ca/recherche/api/3/action/datastore_search?resource_id=32f6ec46-85fd-45e9-945b-965d9235840a&q=';
            $url = $url . $this->search;
            $options = array('http' => array('Accept-language: fr\r\n'));
            $context = stream_context_create($options);
            $jsonPath = public_path('rbq.json');
            $response = Http::get($url);
            $json = file_get_contents($url, false, $context);
            $jsons = json_decode($json, TRUE);
            Log::Debug('Test');
            Log::Debug($jsons['result']['records'][0]);
    
            $rbqCollections= collect(LazyCollection::fromJson($json, "*")->toArray());
            $rbqs = $rbqCollections->all();
            $rbqs = $jsons['result']['records'];

            Log::Debug($rbqs);
        }
            else {
                $rbqs = NULL;
            }
        

     
            $tests = $rbqs;

            

        return view('livewire.validation-r-b-q', compact('tests'));
    }
}
