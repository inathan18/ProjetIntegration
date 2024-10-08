<div class="relative p-2">
    <input
        type="text"
        class="form-input w-full"
        placeholder="Rechercher"
        wire:model.live.debounce.500ms="search"
    />

    <div wire:loading class="absolute w-1/3 bg-white rounded-lg shadow">
        {{-- <div class="list-item">Recherche...</div> --}}
        <ul class="divide-y-2 divide-gray-100">
            <li class="p-2 hover:bg-blue-600 hover:text-blue-200 ">
                Recherche...
            </li>
        </ul>
    </div>

    @if(!empty($search))
        <div class="w-1/3 bg-white rounded-lg shadow">
  
            @if(!empty($tests))
                    <select wire:model.change="noNeq" name="noNeq" class="noNeq" id="noNeq">
                    <option disabled selected value>Choisir une entreprise</option>
                    @php $key=0 @endphp
                    @foreach($tests as $rbq)
                    {{$key++}}
                        <option value="{{$key}}">
                            {{ $rbq['Nom de l\'intervenant'] }} - {{ $rbq['Numero de licence'] }} - {{ $rbq['Statut de la licence'] }} - 
                            @if($rbq['Categorie'])
                            {{ $rbq['Categorie'] }} - 
                            @endif
                            {{ $rbq['Sous-categories']}}
                        </option>
                    @endforeach
        </select>
        <div>
        @if(!empty($noNeq))
            <livewire:supplier-form :noNeq="$tests[$noNeq]"/>
        @endif
        </div>

            @else
                <div class="list-item">No results!</div>
            @endif
        </div>
    @endif
</div>