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

                                <div class="col-6 FormInscription">
                                    <label class="beaulabel" for="city">UNSPSC : </label>
                                    <input class="form-control" type="text" id="unspsc" name="unspsc">
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
</script>

<script src="../localisation.js"></script>
<script src="../telephone.js"></script>
<script src="../Confirmation.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js" integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>




@endsection