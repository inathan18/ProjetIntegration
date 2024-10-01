<div class="relative p-2">
    <input
        type="text"
        class="form-input w-full"
        placeholder="Search"
        wire:model.live.debounce.500ms="search"
    />

    <div wire:loading class="absolute w-1/3 bg-white rounded-lg shadow">
        {{-- <div class="list-item">Searching...</div> --}}
        <ul class="divide-y-2 divide-gray-100">
            <li class="p-2 hover:bg-blue-600 hover:text-blue-200 ">
                Searching...
            </li>
        </ul>
    </div>

    @if(!empty($search))
        <div class="w-1/3 bg-white rounded-lg shadow">
  
            @if(!empty($tests))
                    <select wire:model.change="neq" name="neq">
                    @foreach($tests as $rbq)
                        <option value=" {{ $rbq['_id'] }}">
                            {{ $rbq['Nom de l\'intervenant'] }} - {{ $rbq['Numero de licence'] }} - {{ $rbq['Statut de la licence'] }}
                        </option>
                    @endforeach
        </select>
        <h3>{{$neq}}</h3>

            @else
                <div class="list-item">No results!</div>
            @endif
        </div>
    @endif
</div>