<form id="fournisseur-form">
    <label for="name">Nom</label>
    <input type="text" name="name" id="name">
    <div id="nameError" class="error"></div>

    <label for="address">Adresse</label>
    <input type="text" name="address" id="address">
    <div id="addressError" class="error"></div>

    <label for="postCode">Code postal</label>
    <input type="text" name="postCode" id="postCode">
    <div id="postCodeError" class="error"></div>

    <label for="website">Site Web</label>
    <input type="text" name="website" id="website">
    <div id="websiteError" class="error"></div>

    <label for="personneContact">Personne de contact</label>
    <input type="text" name="personneContact" id="personneContact">
    <div id="personneContactError" class="error"></div>

    <label for="phone">Téléphone</label>
    <input type="text" name="phone" id="phone">
    <div id="phoneError" class="error"></div>

    <label for="email">Email</label>
    <input type="email" name="email" id="email">
    <div id="emailError" class="error"></div>

    <label for="password">Mot de passe</label>
    <input type="password" name="password" id="password">
    <div id="passwordError" class="error"></div>

    <button type="submit">Submit</button>
</form>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.getElementById('fournisseur-form');
        form.addEventListener('submit', function (e) {
            e.preventDefault(); // Prevent form submission

            // Clear previous error messages
            document.querySelectorAll('.error').forEach(div => div.textContent = '');

            // Collect form values
            const formData = new FormData(form);
            const errors = {};

            // Validation Rules
            if (!formData.get('name') || formData.get('name').length < 3) {
                errors.name = "Erreur nom (minimum 3 caractères)";
            }

            if (!formData.get('address')) {
                errors.address = "Erreur adresse";
            }

            if (!formData.get('postCode')) {
                errors.postCode = "Erreur code postal";
            }

            if (!formData.get('website')) {
                errors.website = "Erreur site web";
            }

            if (!formData.get('personneContact')) {
                errors.personneContact = "Erreur personne de contact";
            }

            const phoneRegex = /^\d{3}-\d{3}-\d{4}$/;
            if (!formData.get('phone')) {
                errors.phone = "Le numéro de téléphone est requis";
            } else if (!phoneRegex.test(formData.get('phone'))) {
                errors.phone = "Le numéro de téléphone doit être au format 123-456-7890.";
            }

            if (!formData.get('email')) {
                errors.email = "Erreur email";
            }

            if (!formData.get('password')) {
                errors.password = "Erreur mot de passe";
            }

            // Display Errors
            for (const field in errors) {
                const errorDiv = document.getElementById(`${field}Error`);
                if (errorDiv) {
                    errorDiv.textContent = errors[field];
                }
            }

            // If no errors, proceed with form submission
            if (Object.keys(errors).length === 0) {
                alert("Formulaire soumis avec succès !");
                form.reset(); // Optionally reset the form
            }
        });
    });
</script>

<style>
    .error {
        color: red;
        font-size: 0.9em;
        margin-top: 5px;
    }
</style>
