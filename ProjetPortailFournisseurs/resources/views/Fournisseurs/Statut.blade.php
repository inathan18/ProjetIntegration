@extends('layouts.app')

@section('titre', "Inscription")

@section('link')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js" integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>



<style>


</style>

@endsection

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

                            <div class="form-section">
                                <label for="">Name:</label>
                                <input type="text" class="form-control mb-3" name="name" required>
                                <label for="">Last Name:</label>
                                <input type="text" class="form-control mb-3" name="last_name" required>
                            </div>
                            <div class="form-section">
                                <label for="">E-mail:</label>
                                <input type="email" class="form-control mb-3" name="email" required>
                                <label for="">Phone:</label>
                                <input type="tel" class="form-control mb-3" name="phone"  required>
                            </div>
                            <div class="form-section">
                                <label for="">Address:</label>
                                <textarea name="address" class="form-control mb-3" cols="30" rows="5" required></textarea>
                            </div>

                        <div class="form-navigation mt-3">
                            <button type="button" class="previous btn btn-primary float-left">&lt; Previous</button>
                            <button type="button" class="next btn btn-primary float-right">Next &gt;</button>
                            <button type="submit" class="btn btn-success float-right">Submit</button>
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