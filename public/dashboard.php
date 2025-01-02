<?php
session_start();
// Vérifiez si l'utilisateur est connecté et est admin
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true || $_SESSION['role'] !== 'admin') {
    // Redirigez vers la page de connexion ou affichez un message d'erreur
    header('Location: /connexion.php'); // Remplacez "login.php" par votre page de connexion
    exit();
}
global $pdo;
require "../src/php/views/headerDash.php";

?>

<header>
    <h1>Dashboard</h1>
    <h3>
        <a href="change_passwordAdmin.php">Modifier un mot de passe</a>
    </h3>
    <form method="post" action="logout.php" style="display: inline;">
        <button type="submit" style="background-color: #017ac3; color: #ffffff; border: none; cursor: pointer; padding: 10px;">
            Déconnexion
        </button>
    </form>
</header>


<main>
    <!-- Première boîte avec un graphique -->
    <div class="box">
        <h2>Graphique Camembert</h2>
        <div id="pie-chart"></div>
    </div>

    <!-- Deuxième boîte avec un graphique -->
    <div class="box">
        <h2>Graphique en Barres</h2>
        <div id="bar-chart"></div>
    </div>

</main>
<script type="module" src="./assets/js/dash.js"></script>
</body>
</html>
