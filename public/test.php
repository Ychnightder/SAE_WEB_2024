<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <style>
        .popup-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            visibility: hidden;
            opacity: 0;
            transition: visibility 0s, opacity 0.3s;
        }
        .popup-overlay.visible {
            visibility: visible;
            opacity: 1;
        }
        .popup {
            background: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
        .popup h2 {
            margin-bottom: 10px;
        }
        .popup button {
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .popup button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<form id="registerForm">
    <!-- Vos champs de formulaire -->
    <button type="submit">S'inscrire</button>
</form>

<div class="popup-overlay" id="popupOverlay">
    <div class="popup">
        <h2 id="popupTitle"></h2>
        <p id="popupMessage"></p>
        <button id="popupClose">Fermer</button>
    </div>
</div>

<script>
    const form = document.getElementById('registerForm');
    const popupOverlay = document.getElementById('popupOverlay');
    const popupTitle = document.getElementById('popupTitle');
    const popupMessage = document.getElementById('popupMessage');
    const popupClose = document.getElementById('popupClose');

    // Affiche la popup
    function showPopup(title, message) {
        popupTitle.textContent = title;
        popupMessage.textContent = message;
        popupOverlay.classList.add('visible');
    }

    // Cache la popup
    function hidePopup() {
        popupOverlay.classList.remove('visible');
    }

    // Gestion de la soumission du formulaire
    form.addEventListener('submit', async (event) => {
        event.preventDefault();
        const formData = new FormData(form);

        // Envoi des données au serveur
        const response = await fetch('../src/php/user/process_add_user.php', {
            method: 'POST',
            body: formData,
        });
        const result = await response.json();

        if (result.status === "success") {
            showPopup("Succès", result.message);
            setTimeout(() => {
                window.location.href = "/enquete.php"; // Redirection après succès
            }, 3000);
        } else {
            showPopup("Erreur", result.message);
        }
    });

    popupClose.addEventListener('click', hidePopup);
</script>
</body>
</html>
