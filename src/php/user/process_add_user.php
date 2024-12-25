<?php
session_start();

require_once __DIR__ . "/User.php";
require_once __DIR__ . '/../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = new User(
        nom: $_POST['nom'],
        prenom: $_POST['prenom'],
        email: $_POST['email'],
        password: $_POST['password'],
        adresse: $_POST['adresse'],
        telephone: $_POST['telephone'],
        idPays: (int)$_POST['IdPays'],
        idVille: (int)$_POST['idVille'],
        dateInscription: $_POST['date_inscription']
    );
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