function selectOption(button) {
  // Récupérer l'ID de l'input depuis le bouton
  const inputId = button.getAttribute("data-target");
  const hiddenInput = document.getElementById(inputId);

  // Mettre à jour la valeur de l'input caché
  hiddenInput.value = button.value;

  // Optionnel : Changer l'apparence du bouton sélectionné
  const buttons = document.querySelectorAll(`[data-target="${inputId}"]`);
  buttons.forEach((btn) => btn.classList.remove("selected"));
  button.classList.add("selected");
}

let currentIndex = 0;
const questions = document.querySelectorAll(".question-slide");
const nextButton = document.getElementById("next-btn");
const prevButton = document.getElementById("prev-btn");
const form = document.querySelector(".form");
const nextStep = form.dataset.nextStep;
function showQuestion(index) {
  questions.forEach((question, i) => {
    if (i === index) {
      question.classList.add("visible");
      question.classList.remove("exit");
    } else if (i < index) {
      question.classList.remove("visible");
      question.classList.add("exit"); // Sortir à gauche
    } else {
      question.classList.remove("visible", "exit"); // Masquer les autres
    }
  });

  // Gestion des boutons
  prevButton.style.display = index > 0 ? "inline-block" : "none";
  nextButton.textContent =
    index === questions.length - 1 ? "Terminer" : "Suivant";
}

nextButton.addEventListener("click", () => {
  if (currentIndex < questions.length - 1) {
    currentIndex++;
    showQuestion(currentIndex);
  } else {
    // alert("Questionnaire terminé !");
    //form.submit();
    console.log("QT");
    window.location.href = `enquete.php?step=${nextStep}`;
  }
});

prevButton.addEventListener("click", () => {
  if (currentIndex > 0) {
    currentIndex--;
    showQuestion(currentIndex);
  }
});

// Initialisation
showQuestion(currentIndex);
