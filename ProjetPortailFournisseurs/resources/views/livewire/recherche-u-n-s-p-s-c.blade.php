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
                <ul class="divide-y-2 divide-gray-100">
                    @foreach($tests as $unspsc)
                        <li class="p-2 hover:bg-blue-600 hover:text-blue-200" wire:key="{{ $unspsc['codeUnspsc']}}">
                            <a
                                href="https://www.google.com"
                                class="padding-top-5 list-item "
                            >{{ $unspsc['codeUnspsc'] }} - {{ $unspsc['descUnspsc'] }}</a>
                        </li>
                    @endforeach
                </ul>
            @else
                <div class="list-item">No results!</div>
            @endif
        </div>
    @endif
</div>