const submitButton = document.getElementById("submit");

const personneContact = document.getElementById("personneContact");

const neq = document.getElementById("test");

const form = document.getElementById("inscription");



input1.addEventListener("keyup", (e) => {
    const value = e.currentTarget.value;
    submitButton.disabled = false;

    if (input1.value === "") {
        submitButton.disabled = true;
    }

});

