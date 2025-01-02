<?php
require_once "../src/php/config/config.php";

// Vérifiez si l'utilisateur est connecté et a le rôle 'user'
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true || $_SESSION['role'] !== 'user') {
    // Redirigez vers la page de connexion
    header('Location: /connexion.php');
    exit();
}

require "../src/php/views/headerDash.php";

?>
<header>
    <h1>Dashboard Utilisateur</h1>
    <form method="post" action="logout.php" style="display: inline;">
        <button type="submit" style="background-color: #017ac3; color: #ffffff; border: none; cursor: pointer; padding: 10px;">
            Déconnexion
        </button>
    </form>
</header>

<main>
    <div class="box">
        <h2>Enquête</h2>
        <p>Vous n'avez pas encore répondu à l'enquête.</p>
        <a href="/enquete.php" style="color: #017ac3; text-decoration: none;">Répondre à l'enquête</a>
    </div>
</main>
</body>
</html>
