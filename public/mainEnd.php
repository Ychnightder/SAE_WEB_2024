<?php
require_once __DIR__ . '/../vendor/autoload.php';
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Titre de la page</title>
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
        <h1 style="margin-bottom: 70px">Merci <span class="name-user"><?php echo $_SESSION["userCurrent"]["prenom"] ?></span> d'avoir répondu</h1>
        <a href="index.php" class="btn">Retour à l'accueil</a>
    </div>
</div>
<div class="wave fond-bot">
    <img src="./assets/image/enquete/Vector.png" alt="une vague">
</div>

</body>
</html>
