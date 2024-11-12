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
                <select wire:model="unspscs" name="unspsc[]" data-live-search="true" data-selected-text-format="static" class="w-full unspsc form-select selectpicker" id="unspsc" multiple title="UNSPSC">
                <option disabled selected value>Choisir un ou des UNSPSC</option>
                    @foreach($tests as $unspsc)
                        <option value="{{$unspsc['codeUnspsc']}}">
                            {{ $unspsc['codeUnspsc'] }} - {{ $unspsc['detailUnspsc'] }}
                        </option>
                    @endforeach
                </select>
                {{--@foreach($tests as $unspsc)
                <div class="flex justify-between">
                <label for="{{$unspsc['codeUnspsc']}}">{{ $unspsc['codeUnspsc'] }} - {{ $unspsc['detailUnspsc'] }}</label>
                <input class="rounded form-checkbox" id="{{$unspsc['codeUnspsc']}}" type="checkbox"
                value="{{$unspsc['codeUnspsc']}}" wire:model.lazy="unspscs"/>
                </div>
                @endforeach--}}

            @else
                <div class="list-item">Aucun résultat!</div>
            @endif
        </div>
    @endif

</div>
@section('scripts')
<script>
$(document).ready(function() {
    $('.selectpicker').selectpicker();

    });
</script>
@endsection