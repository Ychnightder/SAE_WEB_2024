
const buttonSub =  document.querySelector(".sub")
const form  = document.querySelector(".form-conexion")

function  validateConnexion() {
    let isValid = true;

    // Réinitialiser les erreurs
    clearErrors();

    const email = document.getElementById("ID");
    const password = document.getElementById("password");

    if (!email.value.trim() || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value)) {
        isValid = false;
        showError(email, "Veuillez entrer une adresse email valide.");
    }

    if (!password.value.trim() || password.value.length < 8) {
        isValid = false;
        showError(password, "Veuillez entrer votre mot de passe.");
    }

    return isValid;
}

 function showError(input, message) {
    const errorMessage = input.nextElementSibling;
    errorMessage.textContent = message;
    errorMessage.classList.add("show");
    setTimeout(() => {
        errorMessage.classList.remove("show");
    }, 5000);
}
 function clearErrors() {
    const errorMessages = document.querySelectorAll(".error-message");
    errorMessages.forEach((msg) => {
        msg.textContent = "";
        msg.classList.remove("show");
    });
}



buttonSub.addEventListener("click", (e) => {
    e.preventDefault(); // Empêche la soumission du formulaire par défaut

    // Vérifier les entrées avant l'envoi
    if (validateConnexion()) {
        // Si tout est valide, envoyer le formulaire
        form.submit(); // Soumettre le formulaire
    }
});