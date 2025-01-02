<?php
session_start();
require_once "../src/php/helpers/fonction.php";
require_once "../src/php/adhesion_connexion/UserManager.php";

$gestionnaire = new \Pierr\SaeWeb\php\adhesion_connexion\UserManager();

if (!isset($_SESSION["userCurrent"]) ) {
    header("Location: ./index.php?action=connect_user"); // Rediriger si non connecté
    exit();
}
if ($gestionnaire->CheckUserEnquete($_SESSION["userCurrent"]["id"]) ) {
    header("Location: ./index.php"); // Rediriger si non connecté
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Page Principal</title>
    <link rel="stylesheet" href="./assets/css/main.css">
    <link rel="stylesheet" href="./assets/css/enquete-main.css">
</head>
<body>
<div class="wave fond-top">
    <img src="./assets/image/enquete/VectorTop.png" alt="une vague">
</div>
<a class="retour" href="index.php">Retour à l'accueil</a>

<div class="container">
    <div class="logo-box">
        <img src="./assets/image/shared/logo.png" alt="">
    </div>
    <div class="body-container">
        <h1>Bienvenue <span class="name-user"><?php echo $_SESSION["userCurrent"]["prenom"] ?></span> sur notre enquête</h1>
        <h1>Aidez nous à améliorer l'accompagnement des personnes autistes et de leurs proches</h1>
        <a href="questionnaire.php" class="btn">Commencer l'enquête</a>
    </div>
</div>
<div class="wave fond-bot">
    <img src="./assets/image/enquete/Vector.png" alt="une vague">
</div>

</body>
</html>
