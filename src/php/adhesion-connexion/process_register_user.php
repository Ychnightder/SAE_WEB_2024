<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Connexion à la base de données
require_once __DIR__ . '/../config/database.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer et valider les données du formulaire
    $nom = isset($_POST['nom']) ? trim($_POST['nom']) : null;
    $prenom = isset($_POST['prenom']) ? trim($_POST['prenom']) : null;
    $email = isset($_POST['email']) ? trim($_POST['email']) : null;
    $password = isset($_POST['password']) ? $_POST['password'] : null;
    $voie = isset($_POST['voie']) ? trim($_POST['voie']) : null;
    $codepostale = isset($_POST['codepostale']) ? trim($_POST['codepostale']) : null;
    $ville = isset($_POST['ville']) ? trim($_POST['ville']) : null;
    $pays = isset($_POST['pays']) ? trim($_POST['pays']) : "France";
    $telephone = isset($_POST['telephone']) ? trim($_POST['telephone']) : null;

    // Validation des champs obligatoires
    if (empty($nom) || empty($prenom) || empty($email) || empty($password) || empty($voie) || empty($codepostale) || empty($ville) || empty($pays) || empty($telephone)) {
        die("Tous les champs doivent être remplis.");
    }

    // Validation de l'email (simple exemple)
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("L'email est invalide.");
    }

    // Vérification si l'email est déjà utilisé
    $checkEmailQuery = "SELECT COUNT(*) FROM Utilisateurs WHERE nom = :nom AND prenom = :prenom AND email = :email";
    $stmtCheckEmail = $pdo->prepare($checkEmailQuery);
    $stmtCheckEmail->bindParam(':nom', $nom);
    $stmtCheckEmail->bindParam(':prenom', $prenom);
    $stmtCheckEmail->bindParam(':email', $email);
    $stmtCheckEmail->execute();
    $emailCount = $stmtCheckEmail->fetchColumn();


    if ($emailCount > 0) {
        die("Cet email est déjà utilisé.");
    }
    // Sécuriser le mot de passe (hachage)
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Récupérer les identifiants de la ville et du pays
    $stmtVille = $pdo->prepare("SELECT idVille FROM ville WHERE nomVille = :ville");
    $stmtVille->bindParam(':ville', $ville);
    $stmtVille->execute();
    $idVille = $stmtVille->fetchColumn();  // Récupérer l'id de la ville

    $stmtPays = $pdo->prepare("SELECT IdPays FROM pays WHERE nom = :pays");
    $stmtPays->bindParam(':pays', $pays);
    $stmtPays->execute();
    $idPays = $stmtPays->fetchColumn();  // Récupérer l'id du pays

// Préparer la requête pour insérer les données
    $sql = "INSERT INTO Utilisateurs (nom, prenom, email, mot_de_passe, adresse, telephone, IdPays, idVille , est_admin , date_inscription , est_adherent) 
        VALUES (:nom, :prenom, :email, :mot_de_passe, :adresse, :telephone, :idPays, :idVille,0 , now() , 0)";


    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':mot_de_passe', $hashedPassword);
    $stmt->bindParam(':adresse', $voie);
    $stmt->bindParam(':idVille', $idVille);
    $stmt->bindParam(':idPays', $idPays);
    $stmt->bindParam(':telephone', $telephone);

    try {
        if ($stmt->execute()) {
            echo "Inscription réussie !";
            //header("Location:  ../public/index.php"); // Redirige vers la page d'accueil après inscription
            header("Location: /index.php");
            exit();
        } else {
           // header("Location: https://www.amazon.fr/ref=nav_logo");
            echo "Erreur lors de l'inscription.";
        }
    }catch (PDOException $e){
        echo "Erreur de base de données : " . $e->getMessage();
    }
}
?>
