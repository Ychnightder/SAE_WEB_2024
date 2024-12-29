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
