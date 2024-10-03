 <form method="post" action="{{route('Fournisseurs.store')}}">

 <div class="p-3">
        <label class="form-label" for="name">Nom : </label>
        <input readonly class="form-control" type="name" id="name" name="name" wire:model="name" value="{{$name}}">
        
    </div>

    <div class="p-3">
    <label class="form-label" for="rbq">No Licence RBQ: </label>
    <input readonly class="form-control" type="rbq" id="rbq" name="rbq" wire:model="rbq" value="{{$rbq}}">
</div>
    <div class="p-3">
        <label class="form-label" for="address">Adresse : </label>
        <input readonly class="form-control" type="address" id="address" name="address" wire:model="address" value="{{$address}}">
    </div>

    <div class="p-3">
        <label class="form-label" for="city">Ville : </label><br>
        <input readonly class="form-control" name="city"  id="city" wire:model="city" value="{{$city}}">
    </div>

    <div class="p-3">
    <label class="form-label" for="region">Région administrative : </label><br>
        <input readonly class="form-control" name="region" id="region" wire:model="region" value="{{$region}}">
    </div>

    <div class="p-3">
        <label class="form-label" for="province">Province : </label>
<input readonly class="form-control" name="province" id="province" wire:model="province" value="Québec">
    </div>

    <div class="p-3">
        <label class="form-label" for="postCode">Code Postal : </label>
        <input readonly class="form-control" type="postCode" id="postCode" name="postCode" value="{{$postCode}}">
    </div>

        <div class="p-3">
        <label class="form-label" for="country">Pays : </label>
        <input readonly class="form-control" type="country" id="country" name="country" value="Canada">
    </div>

    <div class="p-3">
        <label class="form-label" for="website">Site Web : </label>
        <input class="form-control" type="website" id="website" name="website" value="{{$website}}">
    </div>

    <div class="p-3">
        <label class="form-label" for="statut">Statut : </label>
        <input readonly class="form-control" type="statut" id="statut" name="statut" value="{{$status}}">
    </div>

    <div class="p-3">
        <label class="form-label" for="personneContact">Personne Contact : </label>
        <input class="form-control" type="personneContact" id="personneContact" name="personneContact">
    </div>



    <div class="p-3">
        <label class="form-label" for="email">Courriel : </label>
        <input class="form-control" type="email" id="email" name="email" value="{{$email}}">
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