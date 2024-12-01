<?php
require_once "database.php";

function debug($data) : void
{
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}
function insertPays($countryCode)
{
global $pdo;

$stmt = $pdo->prepare("SELECT IdPays FROM Pays WHERE nom = :nom");
$stmt->bindParam(':nom', $countryCode);
$stmt->execute();
if ($stmt->rowCount() > 0) {
    $insertStmt = $pdo->prepare("INSERT INTO Pays (nom) VALUES (:nom)");
    $insertStmt->bindParam(':nom', $countryCode);
    $insertStmt->execute();
    return $pdo->lastInsertId();
}
    return $stmt->fetchColumn();
}
function insertVille($postalCode, $cityName) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT idVille FROM ville WHERE codePostal = :postalCode AND nomVille = :cityName");
    $stmt->bindParam(':postalCode', $postalCode);
    $stmt->bindParam(':cityName', $cityName);
    $stmt->execute();

    if ($stmt->rowCount() == 0) {
        if (strpos($postalCode, 'CEDEX') !== false || strpos($postalCode, 'SP') !== false || strpos($postalCode, 'CITYSSIMO') !== false|| strpos($postalCode, 'AIR') !== false) {
            // On passe au suivant sans insérer les Cedex
            return;
        }

        $insertStmt = $pdo->prepare("INSERT INTO ville (nomVille, codePostal) VALUES (:cityName, :postalCode)");


        $insertStmt->bindParam(':cityName', $cityName);
        $insertStmt->bindParam(':postalCode', $postalCode);
        $insertStmt->execute();
        return $pdo->lastInsertId(); // Retourne l'ID de la ville nouvellement insérée
    }
    return $stmt->fetchColumn();
}










