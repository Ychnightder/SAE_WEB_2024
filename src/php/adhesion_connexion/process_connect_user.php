<?php

use adhesion_connexion\UserManager;

require_once __DIR__ . "/UserManager.php";
session_start();

$email = isset($_POST['identifiant']) ? trim($_POST['identifiant']) : null;
$password = isset($_POST['password']) ? $_POST['password'] : null;

$errors = [];

$oldInputs = ['identifiant' => $email];


if (empty($email)) {
    $errors['identifiant'] = "L'email est obligatoire.";
}
if (empty($password)) {
    $errors['password'] = "Le mot de passe est obligatoire.";
}


if (!empty($errors)) {
    $_SESSION['login_errors'] = $errors;
    $_SESSION['old_inputs'] = $oldInputs;
    header("Location: /login.php");
    exit;
}


$userManager = new UserManager();
$user = $userManager->authenticate($email, $password);

if ($user) {
    // Connexion réussie
    $_SESSION['user_name'] = $user['nom'];
    $_SESSION['user_prenom'] = $user['prenom'];
    $_SESSION['user_email'] = $user['email'];
    $userManager->logConnection($user['id_utilisateur']);
    header("Location: /main.php");
    exit;
} else {
    $errors['general'] = "Identifiant ou mot de passe incorrect.";
    $_SESSION['login_errors'] = $errors;
    $_SESSION['old_inputs'] = $oldInputs;
    header("Location: /connexion.php");
    exit;
}

