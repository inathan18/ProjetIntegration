@extends('layouts.app')

@section('titre', "Inscription")

@section('link')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js" integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>



<style>


</style>

@endsection

@section('contenu')

<div class="p-3 text-center"> <h1> Satut </h1> </div>



<?php 
session_start();
?>

    <div class="container-fluid p-0" style="height: 100%;">
        <div class="row" style="height: 100%; margin:0px;">

                <div class="col-2 p-0" style="height:100%;"> <!-- Navbar Verticale -->

                <div class="card-container" style="height: 100%; padding:20px;">
                    <div class="persoCardInscription">
                        <div class="card-content">

                        <div class="nav nav-fill my-3">
                          <label class="nav-link shadow-sm step0   border ml-2 ">Step One</label>
                          <label class="nav-link shadow-sm step1   border ml-2 " >Step Two</label>
                          <label class="nav-link shadow-sm step2   border ml-2 " >Step Three</label>
                        </div>

                        </div>
                    </div>
                </div>

                </div>

                <div class="col-10 p-0" style="height:100%;"> <!-- Section Formulaire -->

                <div class="card-container" style="height: 100%; padding:20px;">
                    <div class="persoCardInscription">
                        <div class="card-contentInscription">
                        <br>
                        <form method="post" action="{{route('Fournisseurs.store')}}" class="employee-form">
                            @csrf

                            <div class="container-fluid"  id="Contact">
                                <div class="row">
                                    <div class="p-3 col-4">
                                        <label class="form-label" for="personneContact">Personne Contact : </label>
                                        <input class="form-control" type="personneContact" id="personneContact" name="personneContact[]">
                                    </div>
                                    <div class="col-4 p-3 align-self-center text-center">
                                        <div id="PhonePersonnel">
                                        <div class="phone-number-container col-12" style="margin-top: 10px;">
                                            <label for="phone1">Telephone Personnel</label>
                                            <select name="phone[]" class="phone">
                                                <option value="Bureau">Bureau</option>
                                                <option value="Domicile">Domicile</option>
                                                <option value="Cellulaire">Cellulaire</option>
                                            </select>
                                            <input type="text" name="personneContact[]" min="10" max="12" required>
                                        </div>
                                        <div class="phone-number-container col-12" style="margin-top: 10px;">
                                            <label for="phone1">Telephone Personnel</label>
                                            <select name="phone[]" class="phone">
                                                <option value="Bureau">Bureau</option>
                                                <option value="Domicile">Domicile</option>
                                                <option value="Cellulaire">Cellulaire</option>
                                            </select>
                                            <input type="text" name="personneContact[]" min="10" max="12" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-3 col-4">
                                    <label class="form-label" for="email">Courriel : </label>
                                    <input class="form-control" type="email" id="email" name="personneContact[]">
                                </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary" style="transform:scale(0.6);"onclick="addPersonneContact()">+</button>

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

    $(function(){
        var $sections=$('.form-section');

        function navigateTo(index){

            $sections.removeClass('current').eq(index).addClass('current');

            $('.form-navigation .previous').toggle(index>0);
            var atTheEnd = index >= $sections.length - 1;
            $('.form-navigation .next').toggle(!atTheEnd);
            $('.form-navigation [Type=submit]').toggle(atTheEnd);

     
            const step= document.querySelector('.step'+index);
            step.style.backgroundColor="#17a2b8";
            step.style.color="white";



        }

        function curIndex(){

            return $sections.index($sections.filter('.current'));
        }

        $('.form-navigation .previous').click(function(){
            navigateTo(curIndex() - 1);
        });

        $('.form-navigation .next').click(function(){
            $('.employee-form').parsley().whenValidate({
                group:'block-'+curIndex()
            }).done(function(){
                navigateTo(curIndex()+1);
            });

        });

        $sections.each(function(index,section){
            $(section).find(':input').attr('data-parsley-group','block-'+index);
        });


        navigateTo(0);



    });


</script>

<script src="../localisation.js"></script>
<script src="../telephone.js"></script>
<script src="../Confirmation.js"></script>




@endsection