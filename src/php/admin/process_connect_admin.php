<?php

use config\BDDRequetes;
require_once __DIR__ . '/../helpers/fonction.php';
require_once "../src/php/config/BDDRequetes.php";
session_start();

$errors = [];

$email = isset($_POST['identifiant']) ? trim($_POST['identifiant']) : null;
$password = $_POST['password'] ?? null;
$oldInputs = ['identifiant' => $email];

if (empty($email) || empty($password)) {
    // Message d'erreur si les champs sont vides
    $errors['password'] = "Veuillez mettre un mot de passe";
    $errors['identifiant'] = "Veuillez mettre une email";
    $_SESSION['login_errors'] = $errors;
    header("Location: /admin.php");
    exit;
}

$request = new BDDRequetes();
$pdo = $request->pdo;

try {
    $admin = $request->adminExist($email);
} catch (Exception $e) {
    $errors['identifiant'] = "Aucun compte n'existe avec cette adresse email.";
    $_SESSION['login_errors'] = $errors;
    header("Location: /admin.php");
    exit;
}

try {
    if (!password_verify($password, $request->getPasswordAdmin($email))) {
        $errors['password'] = "Mot de passe incorrect !";
        $_SESSION['login_errors'] = $errors;
        $_SESSION['old_inputs'] = $oldInputs;
        header("Location: /admin.php");
        exit;
    } else {
        $_SESSION['user_email'] = $_POST['identifiant'];
        $_SESSION['logged_in'] = true; // L'utilisateur est connecté
        $_SESSION['role'] = "admin"; // Stocke le rôle (par ex : 'admin' ou 'user')
        header("Location: ./dashboard.php");
        exit;
    }
} catch (Exception $e) {
    $errors['identifiant'] = "Aucun compte n'existe avec cette adresse email.";
    $_SESSION['login_errors'] = $errors;
    $_SESSION['old_inputs'] = $oldInputs;
    header("Location: /admin.php");
    exit;
}
