let phoneCtr = 1; // Start with one phone input field
let ContactCtr = 1;

// Function to add a new phone number input field
function addPhoneNumber() {
    phoneCtr++;
    const telephoneDiv = document.getElementById('phoneNumbers');
    
    // Create new phone number input field
    const addTelephoneDiv = document.createElement('div');
    addTelephoneDiv.classList.add('phone-number-container');
    addTelephoneDiv.classList.add('col-12');
    addTelephoneDiv.id = `phone-${phoneCtr}`;
    addTelephoneDiv.innerHTML = 
    ` <label for="phone${phoneCtr}">Téléphone : </label>
        <select name="phone[]" class="phone ">
            <option value="Bureau">Bureau</option>
            <option value="Domicile">Domicile</option>
            <option value="Cellulaire">Cellulaire</option>
        </select>
        <input type="text" name="phone[]" required>
        <button class="btn btn-danger" style="transform:scale(0.6);" onclick="removePhoneNumber('phone-${phoneCtr}')"> - </button> `;
    
    telephoneDiv.appendChild(addTelephoneDiv);
}


function removePhoneNumber(containerId) {
    const container = document.getElementById(containerId);
    if (container) {
        container.remove();
        phoneCtr--;
    }
}

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