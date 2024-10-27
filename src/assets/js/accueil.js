import { Cards } from "./data.js";

const items = document.querySelectorAll(".card");
const nbSlideinifini = items.length - 2;
const nbSlide = items.length;

const suivant = document.querySelector(".nextBtn");
const precedent = document.querySelector(".prevBtn");

let count = 0;
let autoScrollInterval;

function showSlide(index) {
  const carousel = document.querySelector(".carousel");
  const cardWidth = items[0].clientWidth + 20; // Largeur de chaque carte plus l'espace (gap)
  const offset = -index * cardWidth; // Calcule l'offset basé sur l'index
  carousel.style.transform = `translateX(${offset}px)`; // Applique la translation
}

function startAutoScroll() {
  autoScrollInterval = setInterval(() => {
    count = count < nbSlideinifini ? count + 1 : 0;

    if (count > nbSlideinifini - 1) {
      count = 0; // Recommence au début
    }

    showSlide(count);
  }, 10000); //10000
}
function stopAutoScroll() {
  clearInterval(autoScrollInterval); // Arrête l'intervalle
}
startAutoScroll();

suivant.addEventListener("click", () => {
  stopAutoScroll();
  count++;

  if (count > nbSlide - 3) {
    // Limite à 3 cartes visibles à la fois
    count = 0; // Boucle à la première carte
  }
  showSlide(count);
  startAutoScroll();
});

precedent.addEventListener("click", () => {
  stopAutoScroll();
  count--;

  if (count < 0) {
    count = nbSlide - 3; // Retourne à la dernière position possible
  }
  showSlide(count);
  startAutoScroll();
});

const carousel = document.querySelector(".carrousel-partener");

const itemsPartener = document.querySelectorAll(".carrousel-partener li ");
const totalItems = itemsPartener.length - 6;

let currentIndex = 0;

function moveCarousel() {
  currentIndex++;
  if (currentIndex >= totalItems) {
    currentIndex = 0; // Réinitialiser à 0 lorsque tous les éléments ont été affichés
  }

  const offset = -currentIndex * (carousel.clientWidth / 6);
  carousel.style.transform = `translateX(${offset}px)`;
}

setInterval(moveCarousel, 3000);

function creationDeCardPourCarousel(
  img,
  alt,
  titre,
  dateString,
  text,
  textAfter,
  link,
) {
  const newCard = document.createElement("li");
  newCard.classList.add("card");

  const linksCard = document.createElement("a");
  linksCard.setAttribute("href", link);
  newCard.appendChild(linksCard);

  // Image dans le lien
  const imgNew = document.createElement("img");
  imgNew.classList.add("card-image");
  imgNew.src = img;
  imgNew.alt = alt;
  linksCard.appendChild(imgNew);

  // Contenu de la carte
  const cardContent = document.createElement("div");
  cardContent.classList.add("card-content");
  linksCard.appendChild(cardContent);

  // Titre
  const title = document.createElement("h3");
  title.classList.add("card-title");
  title.textContent = titre;
  cardContent.appendChild(title);

  // Date
  const datePara = document.createElement("p");
  datePara.classList.add("card-date");
  datePara.textContent = dateString;
  cardContent.appendChild(datePara);

  // Description
  const paragraph = document.createElement("p");
  paragraph.classList.add("card-description");
  paragraph.textContent = text;
  cardContent.appendChild(paragraph);

  return newCard;
}

const carrouselContainer = document.querySelector(".carousel");

Cards.forEach((cardData) => {
  const cardElement = creationDeCardPourCarousel(
    cardData.img,
    cardData.alt,
    cardData.titre,
    cardData.date,
    cardData.text,
    cardData.textInAfter,
    cardData.link,
  );

  carrouselContainer.append(cardElement);
});
