@extends('layouts.app')

@section('titre', "Inscription")

@section('contenu')


<div class="p-3 text-center"> <h1> Frame Inscription </h1></div>

<!-- Section Inscription -->
<div id="inscription">
    <div class="p-3">
        <label class="form-label" for="noNeq">Entrer NEQ ou nom de l'entreprise (si vous détenez une licence RBQ): </label>

                @livewire('validation-r-b-q')
    </div>
<form method="post" action="{{route('Fournisseurs.store')}}">
@csrf

    <div class="p-3">
        <label class="form-label" for="name">Nom : </label>
        <input class="form-control" type="name" id="name" name="name">
        
    </div>

        <div class="p-3">
    <label class="form-label" for="neq">No NEQ: </label>
    <input class="form-control" type="neq" id="neq" name="neq">
</div>

    <div class="p-3">
        <label class="form-label" for="address">Adresse : </label>
        <input class="form-control" type="address" id="address" name="address">
    </div>

    <div class="p-3">
        <label class="form-label" for="city">Ville : </label><br>
        <select name="city" class="city" id="city">
            <option value="city">Sélectionnez la ville</option>
        </select>
    </div>
        <div class="p-3">
        <label class="form-label" for="region">Région administrative :</label><br>
        <select name="region" class="region" id="region">
            <option disabled selected value>Sélectionnez la région</option>
            <option value="Autre">Autre</option>
        </select>
    </div>


    <div class="p-3">
        <label class="form-label" for="province">Province : </label>
        <select name="province" class="province " id="province">
            <option disabled selected value>Sélectionnez la province</option>
            <option value='Québec'>Québec</option>
        </select>
    </div>
        <div class="p-3">
    <label class="form-label" for="country">Pays : </label><br>
        <select name="country" class="country " id="country" >
            <option value="Canada">Canada</option>
        </select>
    </div>

    <div class="p-3">
        <label class="form-label" for="postCode">Code Postal : </label>
        <input class="form-control" type="postCode" id="postCode" name="postCode">
    </div>

    <div class="p-3">
        <label class="form-label" for="website">Site Web : </label>
        <input class="form-control" type="website" id="website" name="website">
    </div>

    <div class="p-3">
        <label class="form-label" for="statut">Statut : </label>
        <input class="form-control" type="statut" id="statut" name="statut">
    </div>

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

    <div class="col-4 p-3">
        <div id="phoneNumbers">
        <div class="phone-number-container col-12" style="margin-bottom: 7px;">
            <label for="phone1">Telephone Compagnie</label>
            <select name="phone[]" class="phone">
                <option value="Bureau">Bureau</option>
                <option value="Domicile">Domicile</option>
                <option value="Cellulaire">Cellulaire</option>
            </select>
            <input type="text" name="phone[]" id="phone" min="10" max="12" required>
        </div>
    </div>
    </div>
    <button type="button" class="btn btn-primary" style="transform:scale(0.6);"onclick="addPhoneNumber()">+</button>
    </div>

    <div class="p-3 col-4">
        <label class="form-label" for="email">Courriel compagnie (Connexion au site) : </label>
        <input class="form-control" type="email" id="emailCompagnie" name="email">
    </div>

    <div class="p-3">
        <label class="form-label" for="password">Mot de passe : </label>
        <input class="form-control" type="password" id="password" name="password">
    </div>

    <div class="align-items-center text-center">

        <button disabled class="btn" id="submit" style="background-color: rgba(255,192,203,0.5); border-color: black;" type="submit"
        onclick="var val= document.getElementById('password').value; document.getElementById('password').value(sha512(val));">

            S'inscrire

        </button>

    </div>
</div>
</form>

    <!-- Fin de la Section Inscription -->

    <div class="align-items-center text-center">
        <a class="btn" href="{{route('Fournisseurs.connexionNEQ')}}" style="background-color: rgba(0, 118, 213,0.9); border-color:black;" type="button">
            Connexion
        </a>
    </div>

    <script src="../localisation.js"></script>
    <script src="../telephone.js"></script>

    <script src="../Confirmation.js"></script>


@endsection

@section('scripts')

@endsection