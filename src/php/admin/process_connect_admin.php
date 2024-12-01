<?php
global $pdo;
require_once __DIR__ . '/../config/database.php'; // Chemin vers database.php
require_once __DIR__ . '/../helpers/fonction.php';
session_start();
$email = isset($_POST['identifiant']) ? trim($_POST['identifiant']) : null;
$password = isset($_POST['password']) ? $_POST['password'] : null;

if (empty($email) || empty($password)) {
    // Message d'erreur si les champs sont vides
    echo "pws :" ;debug($password);
    echo"email " ;debug($email);
    die("Veuillez remplir tous les champs.");
}

$sql = "SELECT * FROM Utilisateurs WHERE email = :email AND est_admin = 1 LIMIT 1";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':email', $email, PDO::PARAM_STR);
$stmt->execute();
$user = $stmt->fetch();
if ($user&& password_verify($password, $user['mot_de_passe_admin']) ) { //
    $_SESSION['user_name'] = $user['nom'];
    $_SESSION['user_prenom'] = $user['prenom'];
    $_SESSION['user_email'] = $user['email'];
    debug($user);
    header("Location: /dashboard.php");
    exit;
} else {
    echo "Identifiant ou mot de passe incorrect.";
    $_SESSION['login_error'] = "Identifiant ou mot de passe incorrect.";
    exit;
}