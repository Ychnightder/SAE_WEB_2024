    const btnAdhererEnLigne = document.querySelector('.link-online');
    const btnReturn  = document.querySelector('.first-info .divSubmit .return-btn');
    const formConnexion = document.querySelector(".div-form-conexion"); // Formulaire de connexion
    const formInscription = document.querySelector(".div-form-inscription"); // Formulaire d'inscription (partie 1)
    const btnSuivanteIns1 = document.querySelector(".btn-suivant");
    const formInscriptionPart1 = document.querySelector(".first-info");
    const formInscriptionPart2 = document.querySelector(".second-info");
    btnAdhererEnLigne.addEventListener("click", () => {
        formConnexion.classList.add("hide-left");  // Masquer le formulaire de connexion
        formInscription.classList.add("show-right");  // Afficher le formulaire d'inscription (partie 1)
    });

    btnReturn.addEventListener("click", () => {
        formConnexion.classList.remove("hide-left");
        formInscription.classList.remove("show-right");

        formInscription.classList.remove("hide-left");
    })


    btnSuivanteIns1.addEventListener("click", () => {
        formInscriptionPart1.parentElement.classList.remove("show-right"); // Masquer la partie 1
        formInscriptionPart2.parentElement.classList.add("show-right"); // Afficher la partie 2

        setTimeout(() => {
            formInscriptionPart1.parentElement.classList.remove("hide-left"); // Retirer la classe après l'animation
            formInscriptionPart2.parentElement.classList.remove("show-right"); // Retirer la classe après l'animation
        }, 500); // Correspond à la durée de l'animation
    });

    console.log(btnSuivanteIns1);