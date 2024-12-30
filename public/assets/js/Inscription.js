export const Pays = [
  "France",
  // "Allemagne",
  // "Italie",
  // "Espagne",
  // "Royaume-Uni",
  // "États-Unis",
  // "Canada",
  // "Japon",
  // "Chine",
  // "Brésil",
  // "Argentine",
  // "Russie",
  // "Inde",
  // "Australie",
  // "Mexique",
  // "Afrique du Sud",
  // "Égypte",
  // "Nigéria",
  // "Corée du Sud",
  // "Turquie",
];
const formInscriptionPart1 = document.querySelector(".first-info");
const formInscriptionPart2 = document.querySelector(".second-info");
const btnSuivanteIns1 = document.querySelector(".btn-suivant");
const btnRtr1 = document.querySelector(".return-btn");
const btnReturn2 = document.querySelector(".return-btn2");
btnSuivanteIns1.addEventListener("click", () => {
  if (validateFirstInfo()) {
    formInscriptionPart1.classList.add("hide-left");
    formInscriptionPart2.classList.add("show-right");
  }
});
btnRtr1.addEventListener("click" , ()=>{
  location.href="connexion.php"
})
btnReturn2.addEventListener("click", () => {
  formInscriptionPart1.classList.remove("hide-left");
  formInscriptionPart2.classList.remove("show-right");

  formInscriptionPart2.classList.remove("hide-left");
});
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
function  validateFirstInfo() {
  let isValid = true;

  // Réinitialiser les erreurs
  clearErrors();

  const nom = document.getElementById("nom");
  const prenom = document.getElementById("prenom");
  const email = document.getElementById("Email");
  const password = document.getElementById("pwd");

  if (!nom.value.trim()) {
    isValid = false;
    showError(nom, "Le nom est requis.");
  }

  if (!prenom.value.trim()) {
    isValid = false;
    showError(prenom, "Le prénom est requis.");
  }

  if (!email.value.trim() || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value)) {
    isValid = false;
    showError(email, "Veuillez entrer une adresse email valide.");
  }

  if (!password.value.trim() || password.value.length < 8) {
    isValid = false;
    showError(password, "Le mot de passe doit contenir au moins 8 caractères.");
  }

  return isValid;
}
function validateSecondInfo() {
  let isValid = true;

  clearErrors(); // Réinitialiser les erreurs

  const voie = document.getElementById("voie");
  const codepostale = document.getElementById("codepostale");
  const ville = document.getElementById("ville");
  const telephone = document.getElementById("telephone");

  // Vérifier si la voie est vide
  if (!voie.value.trim()) {
    isValid = false;
    showError(voie, "La voie est requise.");
  }

  // Vérifier si le code postal est vide
  if (!codepostale.value.trim() || !/^\d+$/.test(codepostale.value)) {
    isValid = false;
    showError(codepostale, "Le code postal est requis et doit être un nombre.");
  }

  // Vérifier si la ville est vide
  if (!ville.value.trim()) {
    isValid = false;
    showError(ville, "Veuillez entrer votre ville.");
  }

  // Vérifier la validité du numéro de téléphone (10 chiffres)
  if (!telephone.value.trim() || !/^\d{10}$/.test(telephone.value)) {
    isValid = false;
    showError(telephone, "Le téléphone doit contenir 10 chiffres.");
  }

  return isValid;
}
const btnSubIns = document.querySelector(".sub-inscription");
const formInsctiption = document.querySelector(".form-inscription");
btnSubIns.addEventListener("click", (e) => {
  e.preventDefault(); // Empêche la soumission du formulaire par défaut

  // Vérifier les entrées avant l'envoi
  if (validateFirstInfo() &&validateSecondInfo() ) {
    // Si tout est valide, envoyer le formulaire
    formInsctiption.submit(); // Soumettre le formulaire
  }
});
function remplirSelectPays() {
  const select = document.querySelector(".select-pays");
  Pays.forEach((pays) => {
    const option = document.createElement("option");
    option.text = pays;
    option.value = pays;
    select.appendChild(option);
  });
}
remplirSelectPays();
