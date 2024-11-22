<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
// Récupérer l'identifiant envoyé par le formulaire
    $identifiant = $_POST['ID'];
    $password = $_POST['password'];
   
}
if (!empty($identifiant) && !empty($password)) {
    echo "<script>
            alert('Identifiant : " . htmlspecialchars($identifiant) . "\\nMot de passe : " . htmlspecialchars($password) . "');
        </script>";
    // Vous pouvez ici effectuer des actions supplémentaires, comme une requête SQL
} else {
    echo "<script>alert('Mets un ID');</script>";
}


$host = '172.16.8.65';
$db = 'grp208_3';
$user = 'ilian.desbois';
$pass = 'c2a44c3f';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    echo "Connexion réussie !";
} catch (\PDOException $e) {
    echo "galère un peu";
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
echo "<script>window.location.href = '../../adhesion-connexion.html';</script>";
exit();
?>
