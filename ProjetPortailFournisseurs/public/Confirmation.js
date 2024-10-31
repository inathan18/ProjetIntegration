const submitButton = document.getElementById("submit");

const personneContact = document.getElementById("personneContact");

const neq = document.getElementById("test");

const form = document.getElementById("inscription");



personneContact.addEventListener("keyup", (e) => {
    const value = e.currentTarget.value;
    submitButton.disabled = false;

    if (personneContact.value === "") {
        submitButton.disabled = true;
    }

});

