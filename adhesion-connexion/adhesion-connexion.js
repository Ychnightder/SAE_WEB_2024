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



const addPhone = document.querySelector(".div-button-add .add-num");
const telephoneContainer = document.querySelector(".phone-div");
let  phoneCount = 2;




addPhone.addEventListener('click', function (e) {
  e.preventDefault();

  if (phoneCount < 3) { // Limite à 3 champs au total
    phoneCount++;

    // Créer un nouveau div pour les champs du téléphone
    const newPhoneDiv = document.createElement('div');
    newPhoneDiv.classList.add('telephone-box');

    // Créer et configurer le label pour le "Libelé"
    const labelLibele = document.createElement('label');
    labelLibele.setAttribute('for', `Libele-${phoneCount}`);
    labelLibele.textContent = "Libelé :";

    const selectLibele = document.createElement('select');
    selectLibele.id = `Libele-${phoneCount}`;
    selectLibele.name = `Libele-${phoneCount}`;

    // // Créer les options pour le select
    // const options = [
    //   { value: '', text: 'Libelé', disabled: true, hidden: true, selected: true },
    //   { value: 'Bureau', text: 'Bureau' },
    //   { value: 'Domicile', text: 'Domicile' },
    //   { value: 'Personnelle', text: 'Perso' },
    //   { value: 'Principal', text: 'Principal' },
    //   { value: 'Pro', text: 'Pro' }
    // ];

    // options.forEach(optionData => {
    //   const option = document.createElement('option');
    //   option.value = optionData.value;
    //   option.textContent = optionData.text;
    //   if (optionData.disabled) option.disabled = true;
    //   if (optionData.hidden) option.style.display = 'none';
    //   if (optionData.selected) option.selected = true;
    //   selectLibele.appendChild(option);
    // });

    labelLibele.appendChild(selectLibele);

    // Créer et configurer le label pour le numéro de téléphone
    const labelTelephone = document.createElement('label');
    labelTelephone.setAttribute('for', `telephone-${phoneCount}`);
    labelTelephone.textContent = "Téléphone :";

    const inputTelephone = document.createElement('input');
    inputTelephone.id = `telephone-${phoneCount}`;
    inputTelephone.type = 'text';

    labelTelephone.appendChild(inputTelephone);

    // Ajouter les éléments créés au nouveau div
    newPhoneDiv.appendChild(labelLibele);
    newPhoneDiv.appendChild(labelTelephone);

    const existingChildren = telephoneContainer.children;
    if (existingChildren.length > 1) {
      telephoneContainer.insertBefore(newPhoneDiv, existingChildren[1]);
    } else {
      telephoneContainer.appendChild(newPhoneDiv);
    }
  }

  if (phoneCount === 2 ){
    addPhone.classList.add("hide-left");
    addPhone.classList.remove("show-right");
  }
});
