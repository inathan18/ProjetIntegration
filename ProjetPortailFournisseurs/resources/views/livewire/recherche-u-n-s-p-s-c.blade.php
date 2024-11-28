<div class="container mx-auto p-4">
    <div class="relative">
        <div class="flex space-x-4 mb-4">
            <input
                type="text"
                wire:model.live.debounce.300ms="search"
                placeholder="Rechercher par code ou description"
                class="form-input w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
            />
            <button 
                wire:click="clearAll"
                class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition"
            >
                Réinitialiser
            </button>
        </div>

        <div class="grid grid-cols-3 gap-4">
            <div class="col-span-2 bg-white border rounded-lg shadow-lg max-h-96 overflow-y-auto">
                @if(count($unspscs) > 0)
                    <div class="divide-y divide-gray-200">
                        @foreach($unspscs as $unspsc)
                            <div 
                                wire:key="{{ $unspsc['codeUnspsc'] }}"
                                class="px-4 py-2 hover:bg-blue-50 flex justify-between items-center group"
                            >
                                <div class="flex-grow">
                                    <span class="font-semibold text-blue-600 mr-2">
                                        {{ $unspsc['codeUnspsc'] }}
                                    </span>
                                    <span class="text-gray-700">
                                        {{ Str::limit($unspsc['detailUnspsc'], 100) }}
                                    </span>
                                </div>
                                <div class="flex items-center space-x-2">
<button 
    wire:key="unspsc-button-{{ $unspsc['codeUnspsc'] }}" 
    wire:click="toggleSelection('{{ $unspsc['codeUnspsc'] }}')"
    wire:poll
    class="flex items-center justify-center w-8 h-8 rounded-full border-2 
        {{ in_array($unspsc['codeUnspsc'], $selectedUnspscs) ? 'bg-green-500 border-green-600' : 'bg-gray-200 border-gray-400' }}
        hover:bg-green-600 transition-all duration-200"
    title="{{ in_array($unspsc['codeUnspsc'], $selectedUnspscs) ? 'Désélectionner' : 'Sélectionner' }}"
>
    @if(in_array($unspsc['codeUnspsc'], $selectedUnspscs))
        <!-- Selected state (checkmark) -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
    @else
        <!-- Unselected state (plus) -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
    @endif
</button>








                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="p-4 text-center text-gray-500">
                        Aucun résultat trouvé
                    </div>
                @endif
            </div>

            <div class="bg-gray-50 border rounded-lg shadow-lg p-4">
                @if(count($selectedUnspscs) > 0)
                    <h3 class="font-semibold text-lg mb-2">UNSPSC Sélectionnés</h3>
                    <ul class="space-y-2">
                        @foreach($selectedUnspscs as $selectedCode)
                            @php
                                $selectedUnspsc = collect($unspscs)->firstWhere('codeUnspsc', $selectedCode);
                            @endphp
                            @if($selectedUnspsc)
                                <li class="bg-white p-2 rounded-lg shadow-sm flex justify-between items-center">
                                    <span>
                                        <span class="font-semibold text-blue-600">{{ $selectedUnspsc['codeUnspsc'] }}</span>
                                        <span class="ml-2 text-sm">{{ Str::limit($selectedUnspsc['detailUnspsc'], 30) }}</span>
                                    </span>
                                    <button 
                                        wire:click="toggleSelection('{{ $selectedCode }}')"
                                        class="text-red-500 hover:text-red-700"
                                        title="Désélectionner"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </li>
                            @endif
                        @endforeach
                    </ul>
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
