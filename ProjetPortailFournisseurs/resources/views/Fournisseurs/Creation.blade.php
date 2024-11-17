@extends('layouts.app')

@section('titre', "Inscription")

@section('contenu')

<?php 
session_start();
?>

    <div class="container-fluid p-0" style="height: 100%;">
        <div class="row" style="height: 100%; margin:0px;">

                <div class="col-2 p-0" style="height:100%;"> <!-- Navbar Verticale -->

                <div class="card-container" style="height: 100%; padding:20px;">
                    <div class="persoCardInscription">
                        <div class="card-content">

                        </div>
                    </div>
                </div>

                </div>

                <div class="col-10 p-0" style="height:100%;"> <!-- Section Formulaire -->

                <div class="card-container" style="height: 100%; padding:20px;">
                    <div class="persoCardInscription">
                        <div class="card-contentInscription">
                        <br>
                        <form method="post" action="">

                        <div class="col-6" style="padding-right: 12px">
                            <label class="beaulabel" for="name">Nom de l'entreprise : </label>
                            <input  class="form-control" type="text" id="name" name="name">
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <label class="beaulabel" for="address">address : </label>
                                <input  class="form-control" type="text" id="address" name="address">
                            </div>
                            
                            <div class="col-6 align-self-center">
                                <div id="phoneNumbers">
                                    <div class="phone-number-container col-12">
                                        <label class="beaulabel" for="phone1">Telephone Compagnie</label>
                                        <select name="phone[]" class="phone">
                                            <option value="Bureau">Bureau</option>
                                            <option value="Domicile">Domicile</option>
                                            <option value="Cellulaire">Cellulaire</option>
                                        </select>
                                        <input type="text" name="phone[]" id="phone" min="10" max="12" required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-6">
                                <div class="col-9" style="background-color: #003399; border-radius:25px; padding-top:2px; padding-bottom:2px;">
                                    <label class="beaulabel" for="city">Ville : </label>
                                    <select name="city" class="city" id="city" style="border-radius: 10px;">
                                        <option value="city">Sélectionnez la ville</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-6">
                                <label class="beaulabel" for="region">Région administrative :</label>
                                <select name="region" class="region" id="region">
                                    <option disabled selected value>Sélectionnez la région</option>
                                    <option value="Autre">Autre</option>
                                </select>
                            </div>

                            <div class="col-6">
                                <label class="beaulabel" for="city">NEQ : </label>
                                <input  class="form-control" type="text" id="neq" name="neq">
                            </div>
                            
                            <div class="col-6">
                                <label class="beaulabel" for="city">RBQ : </label>
                                <input  class="form-control" type="text" id="rbq" name="rbq">
                            </div>
                            
                            <div class="container-fluid"  id="Contact">
                                <div class="row">
                                    <div class="p-3 col-4">
                                        <label class="beaulabel" for="personneContact">Personne Contact : </label>
                                        <input class="form-control" type="personneContact" id="personneContact" name="personneContact[]">
                                    </div>

                                    <div class="col-4 align-self-center text-center">
                                        <div id="PhonePersonnel">
                                            <div class="phone-number-container col-12">
                                                <label class="beaulabel" for="phone1">Telephone Personnel</label>
                                                <select name="phone[]" class="phone">
                                                    <option value="Bureau">Bureau</option>
                                                    <option value="Domicile">Domicile</option>
                                                    <option value="Cellulaire">Cellulaire</option>
                                                </select>
                                                <input class="form-control" type="text" name="personneContact[]" min="10" max="12" required>
                                            </div>
                                        </div>
                                    </div>

                                <div class="p-3 col-4">
                                    <label class="beaulabel" for="email">Courriel : </label>
                                    <input class="form-control" type="email" id="email" name="personneContact[]">
                                </div>
                                </div>
                            </div>

                            <div class="col-12">
                            <label class="beaulabel" for="website">Siteweb : </label>
                            <input  class="form-control" type="text" id="nom" name="nom">
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


    <script src="../localisation.js"></script>
    <script src="../telephone.js"></script>
    <script src="../Confirmation.js"></script>

@endsection

@section('scripts')

@endsection