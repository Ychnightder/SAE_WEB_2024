<?php

require_once "BDDConnect.php";

// Connexion à la base de données SQLite
$db = new BDDConnect(__DIR__ . '/database');
$pdo = $db->pdo;

// Lecture du fichier FR.txt
$file = 'FR.txt';
if (!file_exists($file)) {
    die("Fichier FR.txt introuvable.");
}

try {
    $handle = fopen($file, 'r');
    if ($handle) {
        while (($line = fgets($handle)) !== false) {
            // Découper la ligne en colonnes
            $columns = explode("\t", trim($line));

            if (count($columns) > 2) {
                $codePostal = $columns[1];
                $nomVille = $columns[2];

                // Filtrer les codes postaux contenant "CEDEX", "SP", "CITYSSIMO", ou "AIR"
                if (
                    strpos($codePostal, 'CEDEX') !== false ||
                    strpos($codePostal, 'SP') !== false ||
                    strpos($codePostal, 'CITYSSIMO') !== false ||
                    strpos($codePostal, 'AIR') !== false
                ) {
                    // On passe au suivant sans insérer
                    continue;
                }

                // Insertion dans la base de données
                $stmt = $pdo->prepare("
                    INSERT INTO Ville (nomVille, codePostal)
                    VALUES (:nomVille, :codePostal)
                ");
                $stmt->execute([
                    ':nomVille' => $nomVille,
                    ':codePostal' => $codePostal
                ]);
            }
        }
        fclose($handle);
    } else {
        die("Impossible d'ouvrir le fichier FR.txt.");
    }
} catch (Exception $e) {
    die("Erreur lors de la lecture du fichier ou de l'insertion : " . $e->getMessage());
}

echo "Données insérées avec succès.";