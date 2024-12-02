<?php
global $pdo;
require_once "../config/database.php";
require_once "../helpers/fonction.php";

$email = "pierreychnightder52@gmail.com";
$password = "ychnightder";


$sql   = "SELECT * FROM utilisateurs Where :email = '$email'";
$stmt   = $pdo->prepare($sql);
$stmt->bindParam(':email', $email, PDO::PARAM_STR);
$stmt->execute();
$user = $stmt->fetch();
debug($user);
$pass =  password_hash($password, PASSWORD_DEFAULT);

$requete = $pdo->prepare("UPDATE utilisateurs SET est_admin = 1 , mot_de_passe_admin = :mot_de_passe_admin WHERE id_utilisateur = :id_utilisateur ");
$requete->bindParam(':mot_de_passe_admin', $pass, PDO::PARAM_STR);
$requete->bindParam(':id_utilisateur', $user['id_utilisateur'], PDO::PARAM_INT);
$requete->execute();
debug($user);