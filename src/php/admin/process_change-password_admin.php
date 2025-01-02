<?php

use config\BDDRequetes;
use user\User;
require_once "../src/php//user/User.php";
require_once "../src/php/config/BDDRequetes.php";

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $request = new BDDRequetes();
    $errors = [];
    if($request->getUser($_POST['email']) !== null) {
        $errors['email'] = "Aucun admin avec cette adresse mail";
        $_SESSION['register_errors'] = $errors;
        header("Location: /change_passwordAdmin.php");
        exit();
    }


    $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $idVille = $request->getIdVille($_POST['ville']);
    $date = date("Y-m-d");
    $user = new User(
        nom: $_POST['nom'],
        prenom: $_POST['prenom'],
        email: $_POST['email'],
        password: $hashedPassword,
        adresse: $_POST['voie'],
        telephone: $_POST['telephone'],
        idVille: $idVille,
        dateInscription: $date,
        adherent: false
    );
    $result = $request->insertUser($user);
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