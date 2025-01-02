<?php
require_once __DIR__ . '/../config/database.php'; // Chemin vers database.php
require_once __DIR__ . '/../helpers/fonction.php';
$db = new Database();
$pdo = $db->connect();
$email = isset($_POST['identifiant']) ? trim($_POST['identifiant']) : null;
$password = $_POST['password'] ?? null;

if (empty($email) || empty($password)) {
    header("Location : /admin.php");
}

$sql = "SELECT * FROM admin WHERE email = :email";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':email', $email, PDO::PARAM_STR);
$stmt->execute();
$user = $stmt->fetch();

if ($user && password_verify($password, $user['passwordAdmin']) ) { //

    header("Location: ./dashboard.php");
    exit;
} else {
    echo "Identifiant ou mot de passe incorrect.";
    $_SESSION['login_error'] = "Identifiant ou mot de passe incorrect.";
    exit;
}