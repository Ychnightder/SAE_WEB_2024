<?php

use Faker\Factory;
use Pierr\SaeWeb\php\adhesion_connexion\UserManager;
use Pierr\SaeWeb\php\adhesion_connexion\User;
use Pierr\SaeWeb\php\Database\Database;
require  '../../../vendor/autoload.php';

$db = new Database();
$pdo = $db->connect();

$faker = Factory::create('fr_FR');

$nbUsers = 1000;
$userManager = new UserManager();




for ($i = 0; $i < $nbUsers; $i++) {
    // Obtenir un pays et une ville aléatoires depuis la base
    $paysStmt = $pdo->prepare('SELECT IdPays FROM pays WHERE nom = :nomPays LIMIT 1');
    $paysStmt->execute([':nomPays' => 'France']);
    $pays = $paysStmt->fetch();
    if (!$pays) {
        die("Le pays 'France' n'existe pas dans la table 'pays'.");
    }

    $villeStmt = $pdo->query('SELECT idVille FROM ville ORDER BY RAND() LIMIT 1');
    $ville = $villeStmt->fetch();
    if (!$ville) {
        die("Aucune donnée dans la table 'ville'.");
    }

    // Générer un utilisateur aléatoire
    $nom = $faker->lastName;
    $prenom = $faker->firstName;
    $email = $faker->unique()->email;
        $mot_de_passe = password_hash($faker->password(), PASSWORD_BCRYPT); // Hasher le mot de passe
    $adresse = $faker->streetAddress;
    $telephone = $faker->phoneNumber;
    $date_inscription = $faker->date;

    // Insérer l'utilisateur dans la base
    $stmt = $pdo->prepare('
        INSERT INTO utilisateurs 
        (nom, prenom, email, mot_de_passe, adresse, telephone, date_inscription, IdPays, idVille) 
        VALUES 
        (:nom, :prenom, :email, :mot_de_passe, :adresse, :telephone, :date_inscription, :IdPays, :idVille)
    ');

    $stmt->execute([
        'nom' => $nom,
        'prenom' => $prenom,
        'email' => $email,
        'mot_de_passe' => $mot_de_passe,
        'adresse' => $adresse,
        'telephone' => $telephone,
        'date_inscription' => $date_inscription,
        'IdPays' => $pays['IdPays'],
        'idVille' => $ville['idVille']
    ]);

    echo "Utilisateur $nom $prenom ($email) ajouté avec succès.\n";
}
