<?php
require_once __DIR__ . '/../config/database.php'; // Chemin vers database.php
session_start();
$email = isset($_POST['identifiant']) ? trim($_POST['identifiant']) : null;
$password = isset($_POST['password']) ? $_POST['password'] : null;

$errors = [];
$oldInputs = ['identifiant' => $email];

// Vérification des champs vides
if (empty($email)) {
    $errors['identifiant'] = "L'email est obligatoire.";
}
if (empty($password)) {
    $errors['password'] = "Le mot de passe est obligatoire.";
}

if (!empty($errors)) {
    $_SESSION['login_errors'] = $errors;
    $_SESSION['old_inputs'] = $oldInputs;
    header("Location: /connexion.php");
    exit;
}

$sql = "SELECT * FROM utilisateurs WHERE email = :email LIMIT 1";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':email', $email, PDO::PARAM_STR);

$stmt->execute();


$user = $stmt->fetch();

if ($user && password_verify($password, $user['mot_de_passe']) ) {
    $_SESSION['user_name'] = $user['nom'];
    $_SESSION['user_prenom'] = $user['prenom'];
    $_SESSION['user_email'] = $user['email'];
    $sqlInsertOnConnexion = "INSERT INTO connexions (date_connexion_, statut_connexion, id_utilisateur) 
                                 VALUES (NOW(), 1, :id_utilisateur)";
    $stmt = $pdo->prepare($sqlInsertOnConnexion);
    $stmt->bindParam(':id_utilisateur', $user['id_utilisateur'], PDO::PARAM_INT);
    $stmt->execute();

    header("Location: /main.php");
    exit;
} else {
    $errors['general'] = "Identifiant ou mot de passe incorrect.";
    $_SESSION['login_errors'] = $errors;
    $_SESSION['old_inputs'] = $oldInputs;
    header("Location: /connexion.php");
    exit;
}


