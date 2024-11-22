<?php
// Informations de connexion à la base de données MySQL
$host = '172.16.8.65'; // Serveur MySQL
$user = 'ilian.desbois';           // Nom d'utilisateur MySQL
$password = 'c2a44c3f';         // Mot de passe MySQL
$dbname = 'grp208_3';      // Nom de la base de données

// Connexion à la base de données
try {
    // Créer la connexion MySQL
    $conn = new mysqli($host, $user, $password, $dbname);

    // Vérifier la connexion
    if ($conn->connect_error) {
        throw new Exception("Connexion échouée : " . $conn->connect_error);
    }

    // Afficher un message de succès
    echo "Connexion réussie à la base de données !";

    // Fermer la connexion à la base de données
    $conn->close();

} catch (Exception $e) {
    // Afficher une erreur si la connexion échoue
    echo "Erreur : " . $e->getMessage();
}
?>
