<div class="container mx-auto p-4">
    <div class="bg-white shadow-md rounded-lg p-6">
        <div class="mb-4 flex space-x-4">
            <div class="flex-grow">
                <label class="block text-gray-700 text-sm font-bold mb-2">Recherche</label>
                <input
                    type="text"
                    wire:model.live.debounce.300ms="search"
                    placeholder="Rechercher par code ou description"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                />
            </div>

        </div>

        <div class="grid grid-cols-12 gap-4">
            <div class="col-span-8 bg-gray-100 rounded-lg p-4">
                <h2 class="text-lg font-semibold mb-4">Résultats de recherche</h2>
                @if(count($unspscs) > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                        @foreach($unspscs as $unspsc)
                            <div 
                                wire:key="{{ $unspsc['codeUnspsc'] }}"
                                class="bg-white rounded-lg shadow p-3 cursor-pointer transition duration-300 ease-in-out transform hover:scale-105 
                                {{ in_array($unspsc['codeUnspsc'], $selectedUnspscs) ? 'border-2 border-green-500 bg-green-50' : 'border border-gray-200' }}"
                                wire:click="toggleSelection('{{ $unspsc['codeUnspsc'] }}')"
                            >
                                <div class="flex justify-between items-center mb-2">
                                    <span class="font-bold text-blue-600">
                                        {{ $unspsc['codeUnspsc'] }}
                                    </span>
                                </div>
                                <p class="text-sm text-gray-700">
                                    {{ Str::limit($unspsc['detailUnspsc'], 100) }}
                                </p>
                                <div class="text-xs text-gray-500 mt-2">
                                    {{ $unspsc['categoryDesc'] }}
                                </div>
                                                                    @if(in_array($unspsc['codeUnspsc'], $selectedUnspscs))
                                    <div class="flex items-center justify-center h-4 w-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-green-500" fill="none" viewBox="4 4 16 16" stroke="currentColor" style="width: 16px; height: 16px;" >
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        </div>
                                    @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center text-gray-500 py-4">
                        Aucun résultat trouvé
                    </div>
                @endif
            </div>

            <div class="col-span-4 bg-gray-100 rounded-lg p-4">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold">UNSPSC Sélectionnés</h2>
                    @if(!empty($selectedUnspscs))
                        <button 
                            wire:click="$set('selectedUnspscs', [])"
                            class="text-red-500 hover:text-red-700 text-sm"
                        >
                            Tout effacer
                        </button>
                    @endif
                </div>

                @if(!empty($selectedUnspscs))
                    <div class="space-y-2">
                        @foreach($selectedUnspscs as $selectedCode)
                            @php
                                $selectedUnspsc = collect($unspscs)->firstWhere('codeUnspsc', $selectedCode);
                            @endphp
                            @if($selectedUnspsc)
                                <div class="bg-white rounded-lg p-3 flex justify-between items-center shadow">
                                    <div>
                                        <span class="font-bold text-blue-600 mr-2">
                                            {{ $selectedUnspsc['codeUnspsc'] }}
                                        </span>
                                        <span class="text-sm text-gray-700">
                                            {{ Str::limit($selectedUnspsc['detailUnspsc'], 50) }}
                                        </span>
                                    </div>
                                    <button 
                                        wire:click="toggleSelection('{{ $selectedCode }}')"
                                        class="text-red-500 hover:text-red-700"
                                    >
<svg xmlns="http://www.w3.org/2000/svg" class="h-2 w-2" viewBox="4 4 16 16" fill="currentColor" style="width: 16px; height: 16px;">
    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
</svg>
                                    </button>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @else
                    <div class="text-center text-gray-500 py-4">
                        Aucun UNSPSC sélectionné
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
<script>
    Livewire.on('unspscSelectionChanged', () => {
        // This will tell Livewire to re-render the component
        Livewire.emit('refresh');
    });
</script>
