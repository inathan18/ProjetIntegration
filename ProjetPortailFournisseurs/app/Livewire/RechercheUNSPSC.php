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
    public $unspscs = [];
    public $selectedUnspscs = [];
    public $filterCategory = '';
    public $categories = [];
    public $maxResults = 50;
    public $showDetails = false;
    public $selectedDetailCode = null;

    public function updatedSearch()
    {
        if (strlen($this->search) >= 2) {
            $this->filterUnspscs();
        }
    }

    public function filterUnspscs()
    {
        $jsonPath = public_path('unspsc.json');
        $jsonContent = file_get_contents($jsonPath);
        $unspscData = json_decode($jsonContent, true);

        // Modify category extraction
        $this->categories = collect($unspscData)
            ->pluck('categoryDesc')
            ->unique()
            ->filter() // Remove empty values
            ->sort()
            ->values()
            ->toArray();

        $this->unspscs = collect($unspscData)
            ->filter(function ($item) {
                $matchesSearch = empty($this->search) || 
                    stripos(strtolower($item['detailUnspsc']), strtolower($this->search)) !== false ||
                    stripos(strtolower($item['codeUnspsc']), strtolower($this->search)) !== false;

                $matchesCategory = empty($this->filterCategory) || 
                    $item['categoryDesc'] === $this->filterCategory;

                return $matchesSearch && $matchesCategory;
            })
            ->take($this->maxResults)
            ->values()
            ->toArray();
    }

    // Toggle Selection Method
    public function toggleSelection($code)
    {
        // Check if the UNSPSC is already selected
        $index = array_search($code, $this->selectedUnspscs);
    
        if ($index !== false) {
            // If already selected, remove it
            unset($this->selectedUnspscs[$index]);
            $this->selectedUnspscs = array_values($this->selectedUnspscs);  // Reindex the array
        } else {
            // If not selected, add it
            $this->selectedUnspscs[] = $code;
        }
    }
    
    

    public function mount()
    {
        $this->filterUnspscs();
    }
    public function clearAll(){
        $this->search = '';
        $this->selectedUnspscs = [];
        $this->filterCategory = '';
        $this->filterUnspscs();
    }

    public function render()
    {
        return view('livewire.recherche-u-n-s-p-s-c', [
            'unspscs' => $this->unspscs,
            'categories' => $this->categories,
            'selectedUnspscs' => $this->selectedUnspscs,
        ]);
    }
}

