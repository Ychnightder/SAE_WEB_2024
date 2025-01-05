<?php

use config\BDDRequetes;
require_once "../src/php/config/BDDRequetes.php";
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
    $_SESSION['old_inputs'] = $oldInputs;
    $_SESSION['login_errors'] = $errors;
    header("Location: /connexion.php");
    exit;
}

$request = new BDDRequetes();
try {
    $user = $request->getUser($email);
} catch (Exception $e) {
    $errors['identifiant'] = "Aucun compte n'existe avec cette adresse email.";
    $_SESSION['login_errors'] = $errors;
    header("Location: /connexion.php");
    exit;
}

if (!password_verify($password, $user->getPassword())) {
    $errors['password'] = "Mot de passe incorrect !";
    $_SESSION['login_errors'] = $errors;
    $_SESSION['old_inputs'] = $oldInputs;
    header("Location: /connexion.php");
    exit;
}
$_SESSION['logged_in'] = true; // L'utilisateur est connecté
$_SESSION['role'] = "user"; // Stocke le rôle (par ex : 'admin' ou 'user')
$_SESSION['emailUser'] = $email;
header("Location: /dashboardUser.php");
exit;