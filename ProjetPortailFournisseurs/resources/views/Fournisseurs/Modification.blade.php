@extends('layouts.app')

@section('titre', "Modification")

@section('contenu')

@section('body', "V3R-Gris")

<div class="p-3 text-center"> <h1> Modifier mes informations </h1> </div>

<div class="container-fluid h-100">

    <div class="row text-center align-items-center justify-content-center" >
        
    <form method="post" action="{{route('Fournisseurs.update', [$fournisseur_actuel])}}">
    @csrf
    @method('PATCH')


    <p style="display:none;" id="ctr"> {{$Count/6}}  </p>

            <div class="container-fluid" id="Contact">
            @for ($ContactCtr = 0; $ContactCtr < (count($PersonnesContact)/6); $ContactCtr++)
                <div class="row">
                   <div class="p-3 col-4">
                        <label class="beaulabel" for="personneContact">Nom Contact : </label>
                        @if ($ContactCtr != 0) 
                        <button class="btn btn-danger" style="transform:scale(0.6);" onclick="removePersonneContact('Contact-${ContactCtr}')"> - </button>
                        @endif
                        <input class="form-control" type="personneContact" name="personneContact[]" value="{{$PersonnesContact[($ContactCtr *6)]}}" required>
                    </div>
                    <div class="col-4 p-3 align-self-center text-center">
                        <label class="beaulabel" for="phone1">Téléphone : </label>
                        <div id="PhonePersonnel">
                            <div class="phone-number-container col-12" style="margin-top: 10px;">
                                <select name="personneContact[]" class="phone">
                                    @if ($PersonnesContact[($ContactCtr * 6) + 1] == "Bureau")
                                        <option value="Bureau">Bureau</option>
                                        <option value="Domicile">Domicile</option>
                                        <option value="Cellulaire">Cellulaire</option>
                                    @endif
                                    @if ($PersonnesContact[($ContactCtr *6)+1] == "Domicile") {
                                        <option value="Domicile">Domicile</option>
                                        <option value="Bureau">Bureau</option>
                                        <option value="Cellulaire">Cellulaire</option> 
                                    }
                                    @endif
                                    @if ($PersonnesContact[($ContactCtr *6)+1] == "Cellulaire") {
                                        <option value="Cellulaire">Cellulaire</option> 
                                        <option value="Bureau">Bureau</option>
                                        <option value="Domicile">Domicile</option>
                                    }
                                    @endif
                                    @if ($PersonnesContact[($ContactCtr *6)+1] != "Bureau") {
                                        <option value="Bureau">Bureau</option>
                                        <option value="Domicile">Domicile</option>
                                        <option value="Cellulaire">Cellulaire</option>
                                    }
                                    @endif
                                </select>
                                <input type="text" placeholder="xxx-xxx-xxxx" name="personneContact[]" value="{{$PersonnesContact[($ContactCtr *6)+2]}}" required>
                            </div>
                            <div class="phone-number-container col-12" style="margin-top: 10px;">
                                <select name="personneContact[]" class="phone"> 
                                    @if ($PersonnesContact[($ContactCtr *6)+3] == "Bureau") {
                                        <option value="Bureau">Bureau</option>
                                        <option value="Domicile">Domicile</option>
                                        <option value="Cellulaire">Cellulaire</option> 
                                    }
                                    @endif
                                    @if ($PersonnesContact[($ContactCtr *6)+3] == "Domicile") {
                                        <option value="Domicile">Domicile</option>
                                        <option value="Bureau">Bureau</option>
                                        <option value="Cellulaire">Cellulaire</option> 
                                    }
                                    @endif
                                    @if ($PersonnesContact[($ContactCtr *6)+3] == "Cellulaire") {
                                        <option value="Cellulaire">Cellulaire</option> 
                                        <option value="Bureau">Bureau</option>
                                        <option value="Domicile">Domicile</option>
                                    }
                                    @endif
                                    @if ($PersonnesContact[($ContactCtr *6)+3] != "Bureau") {
                                        <option value="Bureau">Bureau</option>
                                        <option value="Domicile">Domicile</option>
                                        <option value="Cellulaire">Cellulaire</option>
                                    }
                                    @endif
                                </select>
                                <input type="text" placeholder="xxx-xxx-xxxx" name="personneContact[]" value="{{$PersonnesContact[($ContactCtr *6)+4]}}" required>
                            </div>
                        </div>
                    </div>
                    <div class="p-3 col-4">
                        <label class="beaulabel" for="personneContact[]">Courriel : </label>
                        <input class="form-control" type="email" id="emailContact" name="personneContact[]" value="{{$PersonnesContact[($ContactCtr *6)+5]}}" required>
                    </div>
                    
                </div>

    @endfor
    
    </div>
    <button type="button" class="btn btn-primary" style="transform:scale(0.6);" onclick="addPersonneContact()">+</button>

        <div class="p3">
            <label class="form-label" for="website">Site Web : </label>
            <input class="form-control" type="text" id="website" name="website" value="{{old('website', $fournisseur_actuel->website)}}">
        </div>

        <button class="btn text-white" style="background-color: #092D74;" type="submit">
            Modifier
        </button>

        </form>

    </div>

</div>

@endsection

<script>

    var ContactCtr = -10;
    
    if (ContactCtr == -10){
     document.addEventListener('DOMContentLoaded', function() {
    ContactCtr = parseInt(document.getElementById('ctr').innerText);
    console.log(ContactCtr);
  }); 
}

// Function to add a new phone number input field

function addPersonneContact() {
    if(ContactCtr < 5) {
    ContactCtr++;
    const ContactDiv = document.getElementById('Contact');

    const addContactDiv = document.createElement('div');
    addContactDiv.classList.add('row');
    addContactDiv.id = `Contact-${ContactCtr}`;

    addContactDiv.innerHTML = 
    `   <div class="p-3 col-4">
            <label class="beaulabel" for="personneContact">Nom Contact : </label>
            <button class="btn btn-danger" style="transform:scale(0.6);" onclick="removePersonneContact('Contact-${ContactCtr}')"> - </button>
            <input class="form-control" type="personneContact" name="personneContact[]">
        </div>

        <div class="col-4 p-3 align-self-center text-center">
            <label class="beaulabel" for="phone1">Téléphone :</label>
            <div id="PhonePersonnel">
            <div class="phone-number-container col-12" style="margin-top: 10px;">
                <select name="personneContact[]" class="phone ">
                    <option value="Bureau">Bureau</option>
                    <option value="Domicile">Domicile</option>
                    <option value="Cellulaire">Cellulaire</option>
                </select>
                <input type="text" name="personneContact[]" placeholder="xxx-xxx-xxxx">
            </div>
            <div class="phone-number-container col-12" style="margin-top: 10px;">
                <select name="personneContact[]" class="phone ">
                    <option value="Bureau">Bureau</option>
                    <option value="Domicile">Domicile</option>
                    <option value="Cellulaire">Cellulaire</option>
                </select>
                <input type="text" name="personneContact[]" placeholder="xxx-xxx-xxxx">
            </div>
        </div>
        </div>

        <div class="p-3 col-4">
            <label class="beaulabel" for="email">Courriel : </label>
            <input class="form-control" type="email" name="personneContact[]">
        </div>`;

    ContactDiv.appendChild(addContactDiv); 
}
}

function removePersonneContact(containerId) {
    const container = document.getElementById(containerId);
    if (container) {
        container.remove();
        ContactCtr--;
    }
}
</script>