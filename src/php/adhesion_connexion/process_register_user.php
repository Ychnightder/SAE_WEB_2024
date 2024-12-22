<?php
session_start();
use adhesion_connexion\UserManager;
require_once __DIR__ . "/UserManager.php";
require_once __DIR__ . '/../config/database.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userManager = new UserManager();

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $voie = $_POST['voie'];
    $codepostale = $_POST['codepostale'];
    $ville = $_POST['ville'];
    $pays = $_POST['pays'];
    $telephone = $_POST['telephone'];

    $result = $userManager->register($nom, $prenom, $email, $password, $voie, $codepostale, $ville, $pays, $telephone);
    echo $result;

    if ($result) {
        // Inscription réussie
        header("Location: /connexion.php");
        exit();
    } else {
        // Redirection avec erreurs
        header("Location: /inscription.php");
        exit();
    }
}
