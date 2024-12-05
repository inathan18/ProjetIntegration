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
                        <form method="post" action="{{route('Fournisseurs.store')}}">
                            @csrf
                        <div class="col-6 FormInscription" style="padding-right: 12px">
                            <label class="beaulabel" for="name">Nom de l'entreprise : </label>
                            <input  class="form-control" type="text" id="name" name="name">
                        </div>

                        <div class="row">
                            <div class="col-6 FormInscription">
                                <label class="beaulabel" for="address">address : </label>
                                <input  class="form-control" type="text" id="address" name="address">
                            </div>
                            
                            <div class="col-6 FormInscription align-self-center">
                                <div class="row justify-content-center">

                                    <div class="col-6" style="background-color: #003399; border-radius:25px; padding-top:2px; padding-bottom:2px;">
                                        <label class="beaulabelSelect" for="phone1">Telephone Comp.</label>
                                        <select name="phone[]" class="phone" style="border-radius:25px;" >
                                            <option value="Bureau">Bureau</option>
                                            <option value="Domicile">Domicile</option>
                                            <option value="Cellulaire">Cellulaire</option>
                                        </select>
                                        <input type="text" name="phone[]" id="phone" min="10" max="12" style="border-radius: 10px; width:30%;" required>
                                    </div>

                                </div>
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
                                <div class="row justify-content-center">

                                    <div class="col-6" style="background-color: #003399; border-radius:25px; padding-top:2px; padding-bottom:2px;">
                                        <label class="beaulabelSelect" for="region">Région:</label>
                                        <select name="region" class="region" id="region" style="border-radius: 10px; width:70%;">
                                            <option disabled selected value>Sélectionnez la région</option>
                                            <option value="Autre">Autre</option>
                                        </select>
                                    </div>

                                </div>
                            </div>

                            <div class="col-6 FormInscription">
                                <label class="beaulabel" for="city">NEQ : </label>
                                <input  class="form-control" type="text" id="neq" name="neq">
                            </div>
                            
                            <div class="col-6 FormInscription">
                                <label class="beaulabel" for="city">RBQ : </label>
                                <input  class="form-control" type="text" id="rbq" name="rbq">
                            </div>

                            <div class="col-6 FormInscription">
                                <label class="beaulabel" for="email">email : </label>
                                <input  class="form-control" type="text" id="email" name="email">
                            </div>
                            
                            <div class="col-6 FormInscription">
                                <label class="beaulabel" for="password">password : </label>
                                <input  class="form-control" type="text" id="password" name="password">
                            </div>
                            
                            

                            <div class="col-12 FormInscription">
                            <label class="beaulabel" for="website">Siteweb : </label>
                            <input  class="form-control" type="text" id="website" name="website">
                            </div>

                        </div>

                        <div class="text-center">
                        <button disabled class="btn" id="submit" style="background-color: #003399; border-color: black; color:white;" type="submit"
                                onclick="var val= document.getElementById('password').value; document.getElementById('password').value(sha512(val));">

                            S'inscrire

                        </button>
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