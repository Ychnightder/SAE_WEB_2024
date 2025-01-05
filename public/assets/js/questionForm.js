let currentIndex = 0;
const questions = document.querySelectorAll(".question-slide");
const nextButton = document.getElementById("next-btn");
const prevButton = document.getElementById("prev-btn");
const form = document.querySelector(".form");
function selectOption(button) {
  // Récupérer l'ID de l'input depuis le bouton
  const inputId = button.getAttribute("data-target");
  const hiddenInput = document.getElementById(inputId);
  hiddenInput.value = button.value;
  const buttons = document.querySelectorAll(`[data-target="${inputId}"]`);
  buttons.forEach((btn) => btn.classList.remove("selected"));
  button.classList.add("selected");
}
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
  // prevButton.style.display = index > 0 ? "inline-block" : "none";
  nextButton.textContent =
    index === questions.length - 1 ? "Terminer" : "Suivant";
}
nextButton.addEventListener("click", () => {
  if (!isCurrentQuestionAnswered()) {
    return; // Bloque l'avancement
  }

  if (currentIndex < questions.length - 1) {
    currentIndex++;
    showQuestion(currentIndex);
    updateStepInput();
  } else {
    if (currentIndex === questions.length - 1) {
      nextButton.setAttribute("type", "submit");
      nextButton.textContent = "Soumettre";
    }
    updateStepInput();
  }
});
prevButton.addEventListener("click", () => {
  if (questions[currentIndex].id === "question-1") {
    location.href = "main.php";
  }

  if (currentIndex > 0) {
    currentIndex--;
    showQuestion(currentIndex);
    updateStepInput();
  }
});
function updateStepInput() {
  const currentQuestion = questions[currentIndex];
  const stepValue = currentQuestion.getAttribute("data-id");

  // Mettre à jour le texte affiché
  const stepDisplay = document.querySelector(".stepbystep");
  stepDisplay.textContent = `${stepValue} sur ${7}`;

  // Mettre à jour la barre de progression
  const progressBar = document.querySelector(".progress-bar").children;
  Array.from(progressBar).forEach((bar, index) => {
    bar.classList.toggle("active", index < stepValue);
  });
}
function isCurrentQuestionAnswered() {
  const currentQuestion = questions[currentIndex];
  const input = currentQuestion.querySelector('[name^="reponses"]');
  if (input) {
    const isAnswered =
      input.type === "text" ||
      input.type === "textarea" ||
      input.type === "hidden"
        ? input.value.trim() !== ""
        : input.tagName === "SELECT"
          ? input.value !== "" && input.value !== "Choisissez une option"
          : false;

    // Ajouter ou supprimer une classe pour indiquer un problème
    if (!isAnswered) {
      currentQuestion.classList.add("error");
      setTimeout(() => {
        currentQuestion.classList.remove("error");
      }, 1000);
    } else {
      currentQuestion.classList.remove("error");
    }
    return isAnswered;
  }
  return false;
}
showQuestion(currentIndex);
//Choisissez une option