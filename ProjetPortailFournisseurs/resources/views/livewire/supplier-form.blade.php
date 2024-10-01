 <form method="post" action="{{route('Fournisseurs.store')}}">

 <div class="p-3">
        <label class="form-label" for="name">Nom : </label>
        <input class="form-control" type="name" id="name" name="name" wire:model="name">
        
    </div>

    <div class="p-3">
        <label class="form-label" for="address">Adresse : </label>
        <input class="form-control" type="address" id="address" name="address" wire:model="address">
    </div>

    <div class="p-3">
        <label class="form-label" for="city">Ville : </label><br>
        <select name="city" class="city " id="city" wire:model="city">
            <option value="city">Sélectionnez la ville</option>
        </select>
    </div>

    <div class="p-3">
    <label class="form-label" for="country">Pays : </label><br>
        <select name="country" class="country " id="country" wire:model="country">
            <option value="Québec">Québec</option>
        </select>
    </div>

    <div class="p-3">
        <label class="form-label" for="province">Province : </label>
        <select name="province" class="province " id="province">
            <option value="province">Sélectionnez la province</option>
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

    <div class="p-3">
        <label class="form-label" for="personneContact">Personne Contact : </label>
        <input class="form-control" type="personneContact" id="personneContact" name="personneContact">
    </div>



    <div class="p-3">
        <label class="form-label" for="email">Courriel : </label>
        <input class="form-control" type="email" id="email" name="email">
    </div>

    <div class="p-3">
        <label class="form-label" for="password">Mot de passe : </label>
        <input class="form-control" type="password" id="password" name="password">
    </div>

    <div class="align-items-center text-center">

        <button class="btn" style="background-color: rgba(255,192,203,0.5); border-color: black;" type="submit"
        onclick="var val= document.getElementById('password').value; document.getElementById('password').value(sha512(val));">

            S'inscrire

        </button>

    </div>
</form>