<?php
session_start();

// Connexion à la base de données
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../helpers/fonction.php';
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

// Initialisation du tableau des erreurs
    $errors = [];

// Validation des champs
    if (empty($_POST['nom'])) {
        $errors['nom'] = "Le nom est requis.";
    }
    if (empty($_POST['prenom'])) {
        $errors['prenom'] = "Le prénom est requis.";
    }
    if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Une adresse e-mail valide est requise.";
    }
    if (empty($_POST['password'])) {
        $errors['password'] = "Le mot de passe est requis.";
    }
    if (empty($_POST['voie'])) {
        $errors['voie'] = "La voie est requise.";
    }
    if (empty($_POST['codepostale']) || !is_numeric($_POST['codepostale'])) {
        $errors['codepostale'] = "Le code postal est requis et doit être un nombre.";
    }
    if (empty($_POST['ville'])) {
        $errors['ville'] = "La ville est requise.";
    }
    if (empty($_POST['telephone']) || !is_numeric($_POST['telephone'])) {
        $errors['telephone'] = "Le téléphone est requis et doit être un nombre.";
    }

// Si des erreurs sont présentes, stockez-les dans la session et redirigez
    if (!empty($errors)) {
        $_SESSION['register_errors'] = $errors;
        // Vous pouvez rediriger vers la page du formulaire avec les erreurs
        header("Location: /inscription.php");
        exit;
    }

    // Validation de l'email (simple exemple)
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['register_errors'] = "Cet email est non valide.";
        header("Location: /inscription.php");
        exit();
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
        $_SESSION['register_errors'] = "Cet email est déjà utilisé.";
        header("Location: /inscription.php");
        exit();
    }
    // Sécuriser le mot de passe (hachage)
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Récupérer les identifiants de la ville et du pays
    $stmtVille = $pdo->prepare("SELECT idVille FROM ville WHERE nomVille = :ville");
    $stmtVille->bindParam(':ville', $ville);
    $stmtVille->execute();
    $idVille = $stmtVille->fetchColumn();  // Récupérer l'id de la ville

    if (!$idVille) {
        $_SESSION['register_errors'] = "Ville inconnue. Veuillez entrer une ville valide.";
        header("Location: /inscription.php");
        exit();
    }

    $stmtPays = $pdo->prepare("SELECT IdPays FROM pays WHERE nom = :pays");
    $stmtPays->bindParam(':pays', $pays);
    $stmtPays->execute();
    $idPays = $stmtPays->fetchColumn();  // Récupérer l'id du pays

    if (!$idPays) {
        $_SESSION['register_errors'] = "Pays inconnu. Veuillez entrer un pays valide.";
        header("Location: /inscription.php");
        exit();
    }


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
            $_SESSION['success_message'] = "Inscription réussie !";
            header("Location: /connexion.php");
            exit();
        } else {
           // header("Location: https://www.amazon.fr/ref=nav_logo");
            $_SESSION['register_errors'] = "Erreur lors de l'inscription.";
            header("Location: /inscription.php");
            exit();
        }
    }catch (PDOException $e){
        $_SESSION['register_errors'] = "Erreur de base de données : " . $e->getMessage();
        header("Location: /inscription.php");

        exit();
    }
}


?>
