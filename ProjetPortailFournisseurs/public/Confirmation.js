const submitButton = document.getElementById("submit");

const password = document.getElementById("password");

const neq = document.getElementById("test");

const form = document.getElementById("inscription");



password.addEventListener("keyup", (e) => {
    const value = e.currentTarget.value;
    submitButton.disabled = false;

    if (personneContact.value === "") {
        submitButton.disabled = true;
    }

});
