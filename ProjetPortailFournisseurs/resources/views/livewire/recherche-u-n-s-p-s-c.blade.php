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
        <div class="w-1/3 bg-white rounded-lg shadow" wire:ignore>
            @if(!empty($tests))
                <select wire:model="unspsc" name="unspsc[]" class="form-control" id="unspsc" multiple>
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
                <div class="list-item">No results!</div>
            @endif
        </div>
    @endif
@push('scripts')
<script>
        $(document).ready(function () {
            $('#unspsc').select2();
            $('#unspsc').on('change', function (e) {
                var data = $('#unspsc').select2("val");
            @this.set('selectedUnspscs', data);
            });
        });
    </script>
@endpush
</div>