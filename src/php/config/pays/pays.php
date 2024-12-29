<?php

require_once "database.php";
require_once 'functionsCpPays.php';
//https://download.geonames.org/export/zip/
$fileContent = file_get_contents("FR.txt");

// Diviser le contenu en lignes
$lines = explode("\n", $fileContent);

$processedPostalCodes = [];
// Lire chaque ligne
foreach ($lines as $line) {
    // Ignorer les lignes vides ou les lignes d'en-tête
    if (empty(trim($line))) {
        continue;
    }

    // Séparer les valeurs par tabulation ou un autre délimiteur
    $data = explode("\t", trim($line)); // Utilisez \t pour tabulation, ou ',' pour des fichiers CSV, etc.

    if (count($data) >= 10) {
        list($countryCode, $postalCode, $cityName, $regionName, $regionCode) = $data;
        if (in_array($postalCode, $processedPostalCodes)) {
            continue;
        }
        $processedPostalCodes[] = $postalCode;
        // Insérer le pays
        $countryId = insertPays($countryCode);

        // Insérer la ville
        insertVille($postalCode, $cityName);
    }
}

echo "Les données ont été importées avec succès !";



