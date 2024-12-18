<?php

namespace App\Livewire;

use Livewire\Component;
use Cerbero\LazyJson\LazyJson;
use Illuminate\Support\LazyCollection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class ValidationRBQ extends Component
{
    #[Validate('required|numeric|digits:10')]
    public $search = '';

    public $rbq;
    public $noNeq = '';


    public function render()
    {
        $noNeq = '';
        $name = '';
        $selected = '';

        //$result = $url->getBody()->getContents();
       // Log::Debug($result->result->records);

        if(!empty($this->search)){
           

            $url = 'https://www.donneesquebec.ca/recherche/api/3/action/datastore_search?resource_id=32f6ec46-85fd-45e9-945b-965d9235840a&q=';
            $url = $url . \rawurlencode($this->search);
            $options = array('http' => array('Accept-language: fr\r\n'));
            $context = stream_context_create($options);
            $jsonPath = public_path('rbq.json');
            $response = Http::get($url);
            $json = file_get_contents($url, false, $context);
            $jsons = json_decode($json, TRUE);
            //Log::Debug('Test');
            //Log::Debug($jsons['result']['records'][0]);
    
            $rbqCollections= collect(LazyCollection::fromJson($json, "*")->toArray());
            $rbqs = $rbqCollections;
            $rbqs = $jsons['result']['records'];
            $typesRbq = [];
            //Log::Debug($rbqs);
            
            foreach($rbqs as $temp){
                $typesRbq []= $temp['Sous-categories'];
                /*
                $rbqs = $rbqs + [
                    'typesRbq'[$i] => $temp['Sous-categories']
                ];*/
                
                
            }
            array_push($rbqs[0], $typesRbq);


            //Log::Debug($rbqs);
            }

        
            else {
                $rbqs = NULL;
            }
        

     
            $tests = $rbqs;


            

        return view('livewire.validation-r-b-q', compact('tests'));
    }
}
