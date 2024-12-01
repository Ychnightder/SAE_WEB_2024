<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./assets/css/main.css" />
    <link rel="stylesheet" href="./assets/css/adhesion-connexion.css"  />
    <?php

    $currentPage = basename($_SERVER['PHP_SELF'], ".php");
    $pageTitles = [
        "inscription" => "Inscription | Autisme France",
        "connexion" => "Connexion | Autisme France",
    ];
    $title = $pageTitles[$currentPage] ?? "Autisme France";
    ?>
    <script
        src="./assets/js/adhesion-connexion.js"
        type="module"
    ></script>
    <title><?= htmlspecialchars($title) ?></title>
</head>

<body>
<main class="main">
