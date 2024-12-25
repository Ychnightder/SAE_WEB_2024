<?php

use config\BDDRequetes;
use user\User;
require_once "User.php";
require_once "../config/BDDRequetes.php";

$hashedPassword = password_hash("test", PASSWORD_DEFAULT);

$user = new User (
    nom: "db",
    prenom: "ilian",
    email: "ilian@gmail.com",
    password: $hashedPassword,
    adresse: "8 rue lol",
    telephone: "4567891230",
    idVille: 5,
    dateInscription: date('Y-m-d H:i:s'),
    adherent: false
);

$request = new BDDRequetes();
$result = $request->insertUser($user);