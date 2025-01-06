<?php
session_start();
use Pierr\SaeWeb\php\adhesion_connexion\UserManager;

$email = isset($_POST['identifiant']) ? trim($_POST['identifiant']) : null;
$password = $_POST['password'] ?? null;

$errors = [];
$oldInputs = ['identifiant' => $email];

if (empty($email)) {
    $errors['identifiant'] = "L'email est obligatoire.";
}
if (empty($password)) {
    $errors['password'] = "Le mot de passe est obligatoire.";
}
if (!empty($errors)) {
    $_SESSION['login_errors'] = $errors;
    $_SESSION['old_inputs'] = $oldInputs;
    header("Location: /login.php");
    exit;
}

$userManager = new UserManager();
$user = $userManager->authenticate($email, $password);

if ($user) {
    // Connexion réussie
    $_SESSION['userCurrent'] = [
        'id' => $user['id_utilisateur'],
        'nom' => $user['nom'],
        'prenom' => $user['prenom'],
    ] ;
    $userManager->logConnection($user['id_utilisateur']);

    if ($userManager->CheckUserEnquete($_SESSION['userCurrent']["id"]) === false ){
        header("Location: /dashboardUser.php");
        exit;
    }else{
        header("Location: /index.php");
        exit;
    }
} else {
    $errors['general'] = "Identifiant ou mot de passe incorrect.";
    $_SESSION['login_errors'] = $errors;
    $_SESSION['old_inputs'] = $oldInputs;
    header("Location: /connexion.php");
}
exit;

