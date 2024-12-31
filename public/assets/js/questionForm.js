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

// Fonction de validation des champs
function validateCurrentQuestion() {
  const currentQuestion = questions[currentIndex];
  const inputs = currentQuestion.querySelectorAll("input, textarea, select");
  let isValid = true;

  inputs.forEach((input) => {
    const errorMsg = currentQuestion.querySelector(".error-msg");

    if (!input.value.trim()) {
      isValid = false;

      // Ajouter un message d'erreur si absent
      if (!errorMsg) {
        const error = document.createElement("p");
        error.className = "error-msg";
        error.style.color = "red";
        error.textContent = "Veuillez répondre à cette question.";
        currentQuestion.appendChild(error);
      }
    } else if (errorMsg) {
      errorMsg.remove();
    }
  });

  return isValid;
}
nextButton.addEventListener("click", () => {
  if (validateCurrentQuestion()) {
    if (currentIndex < questions.length - 1) {
      currentIndex++;
      showQuestion(currentIndex);
    } else {
      console.log("QT");
      window.location.href = `enquete.php?step=${nextStep}`;
    }
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
