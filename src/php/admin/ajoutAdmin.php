<?php

use config\BDDRequetes;
require_once "../config/BDDRequetes.php";

$email = "ilian.desbois5@gmail.com";
$password = "iliandesbois";

$request = new BDDRequetes();
$pdo = $request->pdo;


$sql = "INSERT INTO Admin(email, password) VALUES(:email, :password)";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':email', $email, PDO::PARAM_STR);
$pass =  password_hash($password, PASSWORD_DEFAULT);
$stmt->bindParam(':password', $pass, PDO::PARAM_STR);
$stmt->execute();