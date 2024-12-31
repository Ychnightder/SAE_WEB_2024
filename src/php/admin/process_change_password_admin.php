<?php
require_once __DIR__ . '/../config/database.php'; // Chemin vers database.php
require_once __DIR__ . '/../helpers/fonction.php';
$db = new Database();
$pdo = $db->connect();


if($_SERVER["REQUEST_METHOD"] == "POST"){

    $email = isset($_POST['emailAdmin']) ? trim($_POST['emailAdmin']) : null;
    $password = $_POST['new-pwd'] ?? null;
    $confirm = $_POST['confirm-new-pwd'] ?? null;
    
    if (empty($email) || empty($password) || empty($confirm) || $password !== $confirm)  {
        header("Location : /change_passwordAdmin.php");
    }
    
    $sql = "update admin set passwordAdmin = :password where email = :email" ;
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email);
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt->bindParam(':password', $password_hash);
    $stmt->execute();
    if ($stmt->execute())
    {
        echo $password;
        echo "change success";
    }
    else{
        echo "change error";
    }
    debug($_POST);
}