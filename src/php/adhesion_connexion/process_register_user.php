<?php
session_start();
use Pierr\SaeWeb\php\adhesion_connexion\UserManager;
use Pierr\SaeWeb\php\adhesion_connexion\User;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userManager = new UserManager();
    $userCurrent = new User(
        $_POST['nom'] ?? '',
        $_POST['prenom'] ?? '',
        $_POST['email'] ?? '',
        $_POST['password'] ?? '',
        $_POST['voie'] ?? '',
        $_POST['telephone'] ?? '',
        $_POST['codepostale'] ?? '',
        $_POST['pays'] ?? '',
        $_POST['ville'] ?? ''
    );
    $result = $userManager->register($userCurrent);
    if ($result === true) {
        // Inscription réussie
        header("Location: /connexion.php");
    } else {
        $error = $result ;
        $_SESSION['register_errors'] = $_SESSION['register_errors'] ?? [];
        $_SESSION['old_inputs'] = $_POST; // Sauvegarder les anciennes valeurs pour les afficher
        header("Location: /inscription.php");

    }
    exit();
}
