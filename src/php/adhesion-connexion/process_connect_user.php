<?php
require_once __DIR__ . '/../config/database.php'; // Chemin vers database.php
session_start();
$email = isset($_POST['identifiant']) ? trim($_POST['identifiant']) : null;
$password = isset($_POST['password']) ? $_POST['password'] : null;
if (empty($email) || empty($password)) {
    // Message d'erreur si les champs sont vides
    echo "pws :" ;debug($password);
    echo"email: " ;debug($email);
    die("Veuillez remplir tous les champs.");
}

$sql = "SELECT * FROM Utilisateurs WHERE email = :email LIMIT 1";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':email', $email, PDO::PARAM_STR);

$stmt->execute();


$user = $stmt->fetch();

if ($user && password_verify($password, $user['mot_de_passe']) ) {
    
    $_SESSION['user_name'] = $user['nom'];
    $_SESSION['user_prenom'] = $user['prenom'];
    $_SESSION['user_email'] = $user['email'];
    echo "bonjour ". $user['nom'] ." ". $user['prenom'];
//    header("Location: ../../../public/index.php");
    header("Location: /index.php");
    exit;
} else {
    // Erreur d'authentification : email ou mot de passe incorrect
    echo "Identifiant ou mot de passe incorrect.";
    $_SESSION['login_error'] = "Identifiant ou mot de passe incorrect.";
   // header("Location: ./index.php"); // Rediriger vers la page de connexion avec un message d'erreur
    exit;
}