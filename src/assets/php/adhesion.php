<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
// Récupérer l'identifiant envoyé par le formulaire
    $identifiant = $_POST['ID'];
    $mdp =  password_hash($_POST['password'], PASSWORD_DEFAULT);

}
if (empty($identifiant) || empty($mdp)) {
    echo "<script>alert('Veuillez entrer un Identifiant et un Mot de passe !');</script>";
    echo "<script>window.history.back();</script>";
    exit();
}
$host = 'sql111.infinityfree.com';
$dbname = 'if0_37762635_sae';
$username = 'if0_37762635';
$password = 'actQ6sc8taz';

try {
    // Création d'une nouvelle instance PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

} catch (PDOException $e) {
    // Gestion des erreurs de connexion
    echo "<script>alert('Mot de passe incorrect !')</script>";
}

try {
    // Exemple d'insertion d'utilisateur
    $sql = "INSERT INTO Account(identifiant, password) VALUES (:id, :password)";
    $stmt = $pdo->prepare($sql);

    // Assignation des paramètres
    $stmt->bindParam(':id', $identifiant);
    $stmt->bindParam(':password', $mdp);
    // Exécution de la requête
    $stmt->execute();

    echo "Utilisateur inséré avec succès.";
} catch (PDOException $e) {
    echo "Erreur lors de l'insertion : " . $e->getMessage();
}
echo "<script>window.history.back();</script>";
exit();
?>