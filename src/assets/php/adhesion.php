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
echo "<script>window.location.href = '../../adhesion-connexion.html';</script>";
exit();
?>
