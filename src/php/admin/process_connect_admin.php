<?php

use config\BDDRequetes;
require_once __DIR__ . '/../helpers/fonction.php';
require_once "../src/php/config/BDDRequetes.php";

session_start();
$email = isset($_POST['identifiant']) ? trim($_POST['identifiant']) : null;
$password = $_POST['password'] ?? null;

if (empty($email) || empty($password)) {
    // Message d'erreur si les champs sont vides
    echo "pws :" ;debug($password);
    echo"email " ;debug($email);
    die("Veuillez remplir tous les champs.");
}

$request = new BDDRequetes();
$pdo = $request->pdo;

$sql = "SELECT * FROM Admin WHERE email = :email";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':email', $email, PDO::PARAM_STR);
$stmt->execute();
$user = $stmt->fetch();
if ($user && password_verify($password, $user['password']) ) { //
    $_SESSION['user_name'] = $user['nom'];
    $_SESSION['user_prenom'] = $user['prenom'];
    $_SESSION['user_email'] = $user['email'];
    debug($user);
    header("Location: ./dashboard.php");
    exit;
} else {
    echo "Identifiant ou mot de passe incorrect.";
    $_SESSION['login_error'] = "Identifiant ou mot de passe incorrect.";
    exit;
}