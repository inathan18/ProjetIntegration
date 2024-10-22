let phoneCtr = 1; // Start with one phone input field

// Function to add a new phone number input field
function addPhoneNumber() {
    phoneCtr++;
    const telephoneDiv = document.getElementById('phoneNumbers');
    
    // Create new phone number input field
    const addTelephoneDiv = document.createElement('div');
    addTelephoneDiv.classList.add('phone-number-container');
    addTelephoneDiv.classList.add('col-12');
    addTelephoneDiv.id = `phone-${phoneCtr}`;
    addTelephoneDiv.innerHTML = `
        <label for="phone${phoneCtr}">Telephone</label>
        <select name="phone[]" class="phone " id="phone">
            <option value="Bureau">Bureau</option>
            <option value="Domicile">Domicile</option>
            <option value="Cellulaire">Cellulaire</option>
        </select>
        <input type="text" name="phone[]" id="phone" required>
        <button class="btn btn-danger" style="transform:scale(0.6);" onclick="removePhoneNumber('phone-${phoneCtr}')"> - </button>
    `;
    
    telephoneDiv.appendChild(addTelephoneDiv);
}


function removePhoneNumber(containerId) {
    const container = document.getElementById(containerId);
    if (container) {
        container.remove();
        phoneCtr--;
    }
}