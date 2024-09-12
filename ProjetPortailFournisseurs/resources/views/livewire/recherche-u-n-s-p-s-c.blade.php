<div class="relative p-2">
    <input
        type="text"
        class="form-input w-full"
        placeholder="Search Contacts..."
        wire:model="search"
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
            @if(!empty($unspscs))
                <ul class="divide-y-2 divide-gray-100">
                    @foreach($unspscs as $i => $unspsc)
                        <li class="p-2 hover:bg-blue-600 hover:text-blue-200">
                            <a
                                href="https://www.google.com"
                                class="padding-top-5 list-item {{ $highlightIndex === $i ? 'highlight' : '' }}"
                            >{{ $unspsc['id'] }} - {{ $unspsc['title'] }}</a>
                        </li>
                    @endforeach
                </ul>
            @else
                <div class="list-item">No results!</div>
            @endif
        </div>
    @endif
</div>