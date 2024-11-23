const cards = document.querySelectorAll(".card ");
const btnNext1 = document.querySelector(".btn-forget-pwd");
const btnNext2 = document.querySelector(".btn-submit1");
const btnBack2 = document.querySelector(".btn-reset");

function showCard(index) {
  cards.forEach((card, i) => {
    if (i === index) {
      card.style.display = "block"; // Affiche la carte
      // console.log(`Carte ${index + 1} affichée`);
    } else {
      card.style.display = "none"; // Cache les autres cartes
    }
  });
}

btnNext1.addEventListener("click", () => showCard(1)); // Connexion → Changer de mot de passe
btnNext2.addEventListener("click", () => showCard(2)); // Changer de mot de passe → Validation
btnBack2.addEventListener("click", () => showCard(0)); // Retour à Connexion

const InputConnexion = document.querySelector("#identifiant");
const InputIdChangeMdp = document.querySelector("#reset-pwd");
const InputCodeAuth = document.querySelector("#code-auth");
InputConnexion.addEventListener("input", function (event) {
  event.target.value = event.target.value.replace(/\D/g, "");
});

InputIdChangeMdp.addEventListener("input", function (event) {
  event.target.value = event.target.value.replace(/\D/g, "");
});
InputCodeAuth.addEventListener("input", function (event) {
  event.target.value = event.target.value.replace(/\D/g, "");
});
