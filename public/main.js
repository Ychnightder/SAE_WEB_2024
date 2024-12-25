const formConnexion = document.querySelector(".form-conexion");
const formInscription = document.querySelector(".form-inscription");
const formAdmin = document.querySelector(".form-admin");

function validateForm(event, form) {
  const inputs = document.querySelectorAll("input, select");
  let isValid = true;

  inputs.forEach((input) => {
    const errorMessage = input.nextElementSibling; // L'élément suivant pour afficher les erreurs
    let errorText = "";

    if (input.required && input.value.trim() === "") {
      isValid = false;
      input.classList.add("error");
      errorText = "Ce champ est requis";
    } else if (
      input.type === "email" &&
      !input.value.match(/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/)
    ) {
      isValid = false;
      input.classList.add("error");
      errorText = "L'email n'est pas valide";
    } else if (input.type === "password" && input.value.length < 6) {
      isValid = false;
      input.classList.add("error");
      errorText = "Le mot de passe doit contenir au moins 6 caractères";
    } else if (
      (input.type === "number" || input.type === "tel") &&
      !input.value.match(/^\d+$/)
    ) {
      isValid = false;
      input.classList.add("error");
      errorText = "Ce champ doit contenir uniquement des chiffres";
    } else if (input.tagName === "SELECT" && input.value.trim() === "") {
      isValid = false;
      input.classList.add("error");
      errorText = "Veuillez sélectionner une option";
    } else {
      input.classList.remove("error");
      errorText = "";
    }

    if (errorText) {
      errorMessage.textContent = errorText;
      errorMessage.style.display = "block";
    } else {
      errorMessage.textContent = "";
      errorMessage.style.display = "none";
    }
  });

  if (isValid) {
    // Si tout est valide, envoie le formulaire
    form.submit();
    // if (formId === ".form_connexion"){
    //     formConnexion.submit();
    //
    // }else if( formId === ".form-inscription"){
    //     formInscription.submit();
    // }
    // else if (formId === ".form-admin"){
    //     formAdmin.submit();
    // }
  } else {
    event.preventDefault(); // Empêche l'envoi par défaut si validation échoue
  }
}

document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll(".form-inscription").forEach((form) => {
    form.addEventListener("submit", function (event) {
      event.preventDefault();
      validateForm(event, form);
    });
  });

  document.querySelectorAll(".form-connexion").forEach((form) => {
    form.addEventListener("submit", function (event) {
      event.preventDefault();
      validateForm(event, form);
    });
  });

  document.querySelectorAll(".form-admin").forEach((form) => {
    form.addEventListener("submit", function (event) {
      event.preventDefault();
      validateForm(event, form);
    });
  });
});
