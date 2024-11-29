<?php
// Paramètres de connexion à la base de données
$dbHost = 'localhost';    // Adresse du serveur
$dbName = 'autisme_france'; // Nom de la base de données
$dbUser = 'root';          // Nom d'utilisateur
$dbPass = 'ychnightder';              // Mot de passe (laisser vide si aucun)
$dbCharset = 'utf8mb4';    // Jeu de caractères

// Options pour PDO
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Affiche les erreurs sous forme d'exception
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Récupère les résultats sous forme de tableau associatif
    PDO::ATTR_EMULATE_PREPARES => false, // Désactive l'émulation des requêtes préparées
];

try {
    // Création de l'objet PDO
    $dsn = "mysql:host=$dbHost;dbname=$dbName;charset=$dbCharset";
    $pdo = new PDO($dsn, $dbUser, $dbPass, $options);

//  echo "Connexion à la base de données réussie !";

} catch (PDOException $e) {
    // Gère les erreurs de connexion
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
