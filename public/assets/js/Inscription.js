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
