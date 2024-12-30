<?php
require_once __DIR__ . '/../config/database.php'; // Chemin vers database.php
require_once __DIR__ . '/../helpers/fonction.php';
$db = new Database();
$pdo = $db->connect();
$email =  "pierreychnightder52@gmail.com";
$password = password_hash("ychnightder", PASSWORD_DEFAULT);

$sql = "INSERT INTO admin (Email, passwordAdmin) VALUES (:email, :password)";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':password', $password);
//$stmt->execute();
