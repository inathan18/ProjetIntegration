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
                <select wire:model.change="unspscs" name="unspsc[]" class="w-full unspsc form-select" id="unspsc">
                <option disabled selected value>Choisir un ou des UNSPSC</option>
                @php $key=0 @endphp
                    @foreach($tests as $unspsc)
                    {{$key++}}
                        <option value="{{$key}}">
                            {{ $unspsc['codeUnspsc'] }} - {{ $unspsc['detailUnspsc'] }}
                        </option>
                    @endforeach
                </select>
            @else
                <div class="list-item">Aucun résultat!</div>
            @endif
        </div>
    @endif
<script>
$(document).ready(function(){
$('#unspsc').select2();
$('#unspsc').on('change', function(){
console.log('hi');
});
});
</script>
</div>