<?php

// Définir les informations de connexion à la base de données
$host = 'localhost';
$dbname = 'autisme_france'; // Nom de votre base de données
$username = 'root'; // Nom d'utilisateur de la base de données
$password = 'ychnightder'; // Mot de passe de la base de données
try {
    $pdo = new PDO('mysql:host=localhost;dbname=autisme_france;charset=utf8', 'root', 'ychnightder');
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

$query = $pdo->prepare("SELECT * FROM autisme_france.admins");
if ($query->execute()) {
    $result = $query->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        echo "ID: " . $result['id_admin'] . "<br>";
        echo "Role: " . $result['role'] . "<br>";
        echo "id_utilisateur: " . $result['id_utilisateur'] . "<br>";
        echo "login: " . $result['login'] . "<br>";
        echo "Password: " . $result['password'] . "<br>";
    } else {
        echo "Aucun résultat trouvé.";
    }
}

//// Vérifier si le formulaire de connexion a été soumis
//if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//    // Récupérer les données POST de manière sécurisée
//    if (isset($_POST['identifiant'], $_POST['password'])) {
//        $user = $_POST['identifiant'];
//        $pass = $_POST['password'];
//
//        // Rechercher l'utilisateur dans la base de données
//        $query = $pdo->prepare("SELECT * FROM autisme_france.admins WHERE identifiant = :login");
//        $query->execute(['login' => $user]);
//        $result = $query->fetch(PDO::FETCH_ASSOC);
//
//        // Vérifier le mot de passe
//        if ($result && password_verify($pass, $result['password'])) {
//            // Authentifier l'utilisateur
//            $_SESSION['admin'] = $result['identifiant'];
//            $_SESSION['role'] = $result['role'] ?? 'user'; // Stocker le rôle si disponible
//
//            // Rediriger vers le tableau de bord
//            header("Location: dashboard.php");
//            exit();
//        } else {
//            // Identifiant ou mot de passe incorrect
//            echo "Identifiant ou mot de passe incorrect.";
//        }
//    } else {
//        echo "Veuillez remplir tous les champs.";
//    }
//}
?>
