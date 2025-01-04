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
function validateConnexion() {
  let isValid = true;

  // Réinitialiser les erreurs
  clearErrors();
  const email = document.getElementById("identifiant");
  const password = document.getElementById("password");

  if (!email.value.trim() || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value)) {
    isValid = false;
    showError(email, "Veuillez entrer une adresse email valide.");
  }

  if (!password.value.trim() || password.value.length < 8) {
    isValid = false;
    showError(password, "Veuillez entrer votre mot de passe.");
  }
  return isValid;
}
const btnSub = document.querySelector(".btn-submit");
const form = document.querySelector(".form-admin");

btnSub.addEventListener("click", (e) => {
  e.preventDefault();
  if (validateConnexion()) {
    form.submit();
  }
});
