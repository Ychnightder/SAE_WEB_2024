<?php
session_start();
$host = 'localhost';
$dbname = 'autisme_france'; // Votre nom de base de données
$username = 'root'; // Nom d'utilisateur de la base de données
$password = 'ychnightder'; // Mot de passe de la base de données (si vide, sinon renseignez-le)
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die( "Erreur de connexion à la base de données : " . $e->getMessage());
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['identifiant'];
    $pass = $_POST['password'];
    ///123456
///hashed_admin_password_here
    $query = $pdo->prepare("SELECT * FROM admins WHERE id_admin = :username");
    $query->execute(['username' => $user]);
    $result = $query->fetch(PDO::FETCH_ASSOC);

    if ($result && password_verify($pass, $result['password'])) {
        $_SESSION['admin'] = $user;
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Identifiant ou mot de passe incorrect.";
    }
}

?>