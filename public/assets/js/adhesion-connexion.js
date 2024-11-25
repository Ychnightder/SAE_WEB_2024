export const Pays = [
  "France",
  "Allemagne",
  "Italie",
  "Espagne",
  "Royaume-Uni",
  "États-Unis",
  "Canada",
  "Japon",
  "Chine",
  "Brésil",
  "Argentine",
  "Russie",
  "Inde",
  "Australie",
  "Mexique",
  "Afrique du Sud",
  "Égypte",
  "Nigéria",
  "Corée du Sud",
  "Turquie",
];

const btnAdhererEnLigne = document.querySelector(".link-online");
const btnReturn = document.querySelector(".first-info .divSubmit .return-btn");
const formConnexion = document.querySelector(".div-form-conexion"); // Formulaire de connexion
const formInscription = document.querySelector(".div-form-inscription"); // Formulaire d'inscription (partie 1)

btnAdhererEnLigne.addEventListener("click", () => {
  formConnexion.classList.add("hide-left"); // Masquer le formulaire de connexion
  formInscription.classList.add("show-right"); // Afficher le formulaire d'inscription (partie 1)
});

btnReturn.addEventListener("click", () => {
  formConnexion.classList.remove("hide-left");
  formInscription.classList.remove("show-right");

  formInscription.classList.remove("hide-left");
});

const btnSuivanteIns1 = document.querySelector(".btn-suivant");
const formInscriptionPart1 = document.querySelector(".first-info");
const formInscriptionPart2 = document.querySelector(".second-info");
const btnReturn2 = document.querySelector(".return-btn2");

btnSuivanteIns1.addEventListener("click", () => {
  formInscriptionPart1.classList.add("hide-left");
  formInscriptionPart2.classList.add("show-right");
});

btnReturn2.addEventListener("click", () => {
  formInscriptionPart1.classList.remove("hide-left");
  formInscriptionPart2.classList.remove("show-right");

  formInscriptionPart2.classList.remove("hide-left");
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
