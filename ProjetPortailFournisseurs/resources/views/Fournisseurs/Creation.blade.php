@extends('layouts.app')

@section('titre', "Inscription")

@section('link')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js" integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


@endsection

@section('contenu')




<?php
session_start();
?>

<div class="container-fluid p-0 ImageTR" style="height: 100%;">
    <div class="row" style="height: 100%; margin:0px;">

        <div class="col-2 p-0" style="height:100%;"> <!-- Navbar Verticale -->

            <div class="card-container" style="height: 95%; padding:20px;">
                <div class="persoCardInscription">
                    <div class="card-content">

                        <div class="nav nav-fill my-3">
                            <div class="nav-link step0 col-12 border ml-2" style="border-radius: 25px; color:black;">Entreprise</div>
                            <div class="nav-link step1 col-12 border ml-2" style="border-radius: 25px; color:black;">Contact</div>
                            <div class="nav-link step2 col-12 border ml-2" style="border-radius: 25px; color:black;">UNSPSC</div>
                            <div class="nav-link step4 col-12 border ml-2" style="border-radius: 25px; color:black;">Compte</div>
                        </div>

                    </div>
                </div>
            </div>

        </div>

        <div class="col-10 p-0" style="height:100%;"> <!-- Section Formulaire -->

            <div class="card-container" style="height: 95%; padding:20px;">
                <div class="persoCardInscription">
                    <div class="card-contentInscription">
                        <form method="post" action="{{route('Fournisseurs.store')}}" class="fournisseur-form">
                            @csrf

                            <div class="form-section">
                                <div class="col-12 text-center V3R-BleuFonce" style="color:white; border-radius: 20px; padding-bottom: 2px; padding-top: 2px;">
                                    <h1>Informations Fournisseur</h1>
                                </div>

                                <div class="row" style="    margin-left: 2%; margin-right: 2%;">

                                    <div class="col-6 FormInscription" style="padding-right: 12px">
                                        <label class="beaulabel" for="name">Nom de l'entreprise : </label>
                                        <input class="form-control" type="text" id="name" name="name" style="border-radius:15px;">
                                    </div>
                                    <!-- -->

                                    <div class="col-6 FormInscription align-self-center">
                                        <div class="row justify-content-center">

                                            <div class="col-6" style="background-color: #003399; border-radius:25px; padding-top:2px; padding-bottom:2px;">
                                                <label class="beaulabelSelect" for="phone1">Téléphone :</label>
                                                <select name="phone[]" class="phone" style="border-radius:25px;">
                                                    <option value="Bureau">Bureau</option>
                                                    <option value="Domicile">Domicile</option>
                                                    <option value="Cellulaire">Cellulaire</option>
                                                </select>
                                                <input type="text" name="phone[]" id="phone" pattern="^\d{3}-\d{3}-\d{4}$" placeholder="xxx-xxx-xxxx" style="border-radius: 10px; width:30%;">
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-6 FormInscription">
                                        <label class="beaulabel" for="address">Adresse : </label>
                                        <input class="form-control" type="text" id="address" name="address">
                                    </div>

                                    <div class="col-6 FormInscription">
                                        <div class="row justify-content-center">

                                            <div class="col-6" style="background-color: #003399; border-radius:25px; padding-top:2px; padding-bottom:2px;">
                                                <label class="beaulabelSelect" for="city">Ville : </label>
                                                <select name="city" class="city" id="city" style="border-radius: 10px; width:80%;">
                                                    <option value="city">Sélectionnez la ville</option>
                                                </select>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-6 FormInscription">
                                        <label class="beaulabel" for="city">NEQ : </label>
                                        <input class="form-control" type="text" id="neq" name="neq">
                                    </div>

                                    <div class="col-6 FormInscription">
                                        <div class="row justify-content-center">

                                            <div class="col-6" style="background-color: #003399; border-radius:25px; padding-top:2px; padding-bottom:2px;">
                                                <label class="beaulabelSelect" for="region">Région :</label>
                                                <select name="region" class="region" id="region" style="border-radius: 10px; width:70%;">
                                                    <option disabled selected value>Sélectionnez la région</option>
                                                    <option value="Autre">Autre</option>
                                                </select>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-6 FormInscription">
                                        <label class="beaulabel" for="website">Site Internet : </label>
                                        <input class="form-control" type="text" id="website" name="website">
                                    </div>

                                    <div class="col-6 FormInscription">
                                        <label class="beaulabel" for="postCode">Code Postal : </label>
                                        <input class="form-control" type="text" id="postCode" name="postCode">
                                    </div>

                                </div>
                                <!-- -->

                            </div>
                            <!-- Ajout pour voir si le formulaire est fonctionnel -->
                            <div class="form-section">

                                <div class="col-12 text-center V3R-BleuFonce" style="color:white; border-radius: 20px; padding-bottom: 2px; padding-top: 2px;">
                                    <h1>Informations Contacts</h1>
                                </div>

                                <div class="container-fluid" id="Contact">
                                    <div class="row">
                                        <div class="p-3 col-4">
                                            <label class="beaulabel" for="personneContact">Nom Contact : </label>
                                            <input class="form-control" type="personneContact" id="personneContact" name="personneContact[]">
                                        </div>
                                        <div class="col-4 p-3 align-self-center text-center">
                                            <label class="beaulabel" for="phone1">Téléphone : </label>
                                            <div id="PhonePersonnel">
                                                <div class="phone-number-container col-12" style="margin-top: 10px;">
                                                    <select name="personneContact[]" class="phone">
                                                        <option value="Bureau">Bureau</option>
                                                        <option value="Domicile">Domicile</option>
                                                        <option value="Cellulaire">Cellulaire</option>
                                                    </select>
                                                    <input type="text" placeholder="xxx-xxx-xxxx" name="personneContact[]">
                                                </div>
                                                <div class="phone-number-container col-12" style="margin-top: 10px;">
                                                    <select name="personneContact[]" class="phone">
                                                        <option value="Bureau">Bureau</option>
                                                        <option value="Domicile">Domicile</option>
                                                        <option value="Cellulaire">Cellulaire</option>
                                                    </select>
                                                    <input type="text" placeholder="xxx-xxx-xxxx" name="personneContact[]" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="p-3 col-4">
                                            <label class="beaulabel" for="personneContact[]">Courriel : </label>
                                            <input class="form-control" type="email" id="emailContact" name="personneContact[]">
                                        </div>
                                        
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary" style="transform:scale(0.6);" onclick="addPersonneContact()">+</button>

                            </div>

                            <div class="form-section">
                                <div class="col-12 text-center V3R-BleuFonce" style="color:white; border-radius: 20px; padding-bottom: 2px; padding-top: 2px;">
                                    <h1>UNSPSC</h1>
                                </div>
                                <div id="unspsc-search-component" class="container mx-auto p-4">
    <div class="bg-white shadow-md rounded-lg p-6">
        <!-- Search Input -->
        <div class="mb-4 flex space-x-4">
            <div class="flex-grow">
                <label class="block text-gray-700 text-sm font-bold mb-2">Recherche</label>
                <input
                    type="text"
                    id="search-input"
                    placeholder="Rechercher par code ou description"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                />
            </div>
        </div>

        <div class="grid grid-cols-12 gap-4">
            <!-- UNSPSC Results Section -->
            <div class="col-span-8 bg-gray-100 rounded-lg p-4">
                <h2 class="text-lg font-semibold mb-4">Résultats de recherche</h2>
                <div id="unspsc-list" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                    <!-- UNSPSCs will be rendered here -->
                </div>
            </div>

            <!-- Selected UNSPSCs Section -->
            <div class="col-span-4 bg-gray-100 rounded-lg p-4">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold">UNSPSC Sélectionnés</h2>
                    <button
                        id="clear-all-btn"
                        class="text-red-500 hover:text-red-700 text-sm"
                    >
                        Tout effacer
                    </button>
                </div>
                <div id="selected-unspscs-list" class="space-y-2">
                    <!-- Selected UNSPSCs will be rendered here -->
                </div>
            </div>
        </div>
    </div>
</div>

                            </div>

                            <div class="form-section">

                                <div class="col-12 text-center V3R-BleuFonce" style="color:white; border-radius: 20px; padding-bottom: 2px; padding-top: 2px;">
                                    <h1>Informations de Connexion</h1>
                                </div>

                                <div class="col-6 FormInscription">
                                    <label class="beaulabel" for="email">Courriel : </label>
                                    <input class="form-control" type="text" id="email" name="email">
                                </div>

                                <div class="col-6 FormInscription">
                                    <label class="beaulabel" for="password">Mot de passe : </label>
                                    <input class="form-control" type="password" id="password" name="password">
                                </div>

                            </div>
                            <!-- Ajout pour voir si le formulaire est fonctionnel -->

                            <div class="form-navigation mt-3">
                                <button type="button" class="previous btn btn-primary" style="border-radius:15px;">&lt; Précédent</button>
                                <button type="button" class="next btn btn-primary" style="border-radius:15px;">Suivant &gt;</button>
                                <div class="text-center">
                                    <button disabled class="btn" id="submit" style="background-color: #003399; border-color: black; color:white;" type="submit" onclick="var val= document.getElementById('password').value; document.getElementById('password').value(sha512(val));">

                                        S'inscrire

                                    </button>
                                </div>

                            </div>

                        </form>
                    </div>
                </div>
            </div>


        </div>

    </div>
</div>
</div>




@endsection

@section('scripts')

<script>
    $(function() {
        var $sections = $('.form-section');

        function navigateTo(index) {

            $sections.removeClass('current').eq(index).addClass('current');

            $('.form-navigation .previous').toggle(index > 0);
            var atTheEnd = index >= $sections.length - 1;
            $('.form-navigation .next').toggle(!atTheEnd);
            $('.form-navigation [Type=submit]').toggle(atTheEnd);


            const step = document.querySelector('.step' + index);
            step.style.backgroundColor = "#003399";
            step.style.color = "white";
        }


        function curIndex() {

            return $sections.index($sections.filter('.current'));
        }

        $('.form-navigation .previous').click(function() {
            navigateTo(curIndex() - 1);
        });

        $('.form-navigation .next').click(function() {
            $('.fournisseur-form').parsley().whenValidate({
                group: 'block-' + curIndex()
            }).done(function() {
                navigateTo(curIndex() + 1);
            });

        });

        $sections.each(function(index, section) {
            $(section).find(':input').attr('data-parsley-group', 'block-' + index);
        });


        navigateTo(0);



    });

    document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('.fournisseur-form');
    
    if (!form) {
        console.error('Form with class "fournisseur-form" not found');
        return;
    }

    const searchInput = document.getElementById('search-input');
    const unspscList = document.getElementById('unspsc-list');
    const selectedUnspscsList = document.getElementById('selected-unspscs-list');
    const clearAllBtn = document.getElementById('clear-all-btn');

    const state = {
        unspscs: [],
        selectedUnspscs: [],
        search: '',
        maxResults: 5,
        currentPage: 0
    };

    function updateUnspscInput() {
        form.querySelectorAll('input[name="unspscs[]"]').forEach(input => input.remove());
        state.selectedUnspscs.forEach(code => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'unspscs[]';
            input.value = code;
            form.appendChild(input);
        });
    }

    function toggleSelection(code) {
        const index = state.selectedUnspscs.indexOf(code);
        if (index !== -1) {
            state.selectedUnspscs.splice(index, 1);
        } else {
            state.selectedUnspscs.push(code);
        }
        
        renderUnspscs();
        renderSelectedUnspscs();
        updateUnspscInput();
    }

    function renderSelectedUnspscs() {
        if (!selectedUnspscsList) return;

        selectedUnspscsList.innerHTML = state.selectedUnspscs.map(code => {
            const unspsc = state.unspscs.find(item => item.codeUnspsc === code);
            if (!unspsc) return '';
            
            return `
                <div class="bg-white rounded-lg p-3 flex justify-between items-center shadow">
                    <div class="flex-grow">
                        <span class="font-bold text-blue-600 mr-2">${unspsc.codeUnspsc}</span>
                        <span class="text-sm text-gray-700">${unspsc.detailUnspsc.slice(0, 50)}...</span>
                    </div>
                    <button type="button" class="ml-2 p-1 text-red-500 hover:text-red-700 hover:bg-red-50 rounded-full" data-code="${unspsc.codeUnspsc}">
                        ✕
                    </button>
                </div>
            `;
        }).join('');
    }


    function filterUnspscs() {
        return state.unspscs.filter(item => {
            return !state.search || 
                item.codeUnspsc.toLowerCase().includes(state.search.toLowerCase()) ||
                item.detailUnspsc.toLowerCase().includes(state.search.toLowerCase());
        });
    }

    function renderUnspscs() {
        if (!unspscList) return;

        const filteredUnspscs = filterUnspscs();
        const resultsToShow = filteredUnspscs.slice(0, state.maxResults);

        unspscList.innerHTML = resultsToShow.map(item => {
            const isSelected = state.selectedUnspscs.includes(item.codeUnspsc);
            return `
                <div
                    class="bg-white rounded-lg shadow p-3 cursor-pointer transition duration-300 ease-in-out transform hover:scale-105 ${isSelected ? 'border-2 border-green-500 bg-green-50' : 'border border-gray-200'}"
                    data-code="${item.codeUnspsc}"
                >
                    <div class="flex justify-between items-center mb-2">
                        <span class="font-bold text-blue-600">${item.codeUnspsc}</span>
                        ${isSelected ? `
                            <span class="text-green-500 text-xs">✓</span>
                        ` : ''}
                    </div>
                    <p class="text-sm text-gray-700">${item.detailUnspsc.slice(0, 100)}...</p>
                    <div class="text-xs text-gray-500 mt-2">${item.categoryDesc || ''}</div>
                </div>
            `;
        }).join('');
    }

    async function loadUnspscs() {
        try {
            const response = await fetch('/unspsc.json');
            state.unspscs = await response.json();
            renderUnspscs();
        } catch (error) {
            console.error('Error loading UNSPSC data:', error);
        }
    }

    if (searchInput) {
        searchInput.addEventListener('input', (e) => {
            state.search = e.target.value;
            renderUnspscs();
        });
    }

    if (unspscList) {
        unspscList.addEventListener('click', (e) => {
            const codeElement = e.target.closest('[data-code]');
            if (codeElement) {
                const code = codeElement.getAttribute('data-code');
                toggleSelection(code);
            }
        });
    }

    if (selectedUnspscsList) {
        selectedUnspscsList.addEventListener('click', (e) => {
            const button = e.target.closest('button[data-code]');
            if (button) {
                const code = button.getAttribute('data-code');
                toggleSelection(code);
            }
        });
    }

    if (clearAllBtn) {
        clearAllBtn.addEventListener('click', () => {
            state.selectedUnspscs = [];
            renderSelectedUnspscs();
            renderUnspscs();
            updateUnspscInput();
        });
    }

    window.toggleSelection = toggleSelection;
    loadUnspscs();
});
</script>

<script src="../localisation.js"></script>
<script src="../telephone.js"></script>
<script src="../Confirmation.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js" integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>




@endsection