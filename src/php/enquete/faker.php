<?php

use Pierr\SaeWeb\php\Database\Database;
require '../../../vendor/autoload.php';

$db = new Database();
$pdo = $db->connect();

// Récupérer tous les utilisateurs qui n'ont pas encore participé
$utilisateursStmt = $pdo->query('
    SELECT id_utilisateur 
    FROM utilisateurs 
    WHERE has_participated = 0
');
$utilisateurs = $utilisateursStmt->fetchAll(PDO::FETCH_ASSOC);

if (empty($utilisateurs)) {
    die("Tous les utilisateurs ont déjà répondu à toutes les questions.\n");
}

// Récupérer toutes les questions avec leurs options
$questionsStmt = $pdo->query('
    SELECT q.id_question, o.option_text 
    FROM questions q
    LEFT JOIN options o ON q.id_question = o.id_question
');
$questionsOptions = $questionsStmt->fetchAll(PDO::FETCH_GROUP | PDO::FETCH_ASSOC);

if (empty($questionsOptions)) {
    die("Aucune question ou option disponible.\n");
}

foreach ($utilisateurs as $utilisateur) {
    $idUtilisateur = $utilisateur['id_utilisateur'];

    // Vérifier si l'utilisateur a déjà répondu à une question
    $questionsDejaReponduStmt = $pdo->prepare('
        SELECT id_question 
        FROM réponses 
        WHERE id_utilisateur = :id_utilisateur
    ');
    $questionsDejaReponduStmt->execute(['id_utilisateur' => $idUtilisateur]);
    $questionsDejaRepondu = $questionsDejaReponduStmt->fetchAll(PDO::FETCH_COLUMN);

    // Filtrer les questions auxquelles cet utilisateur n'a pas encore répondu
    $questionsRestantes = array_diff(array_keys($questionsOptions), $questionsDejaRepondu);

    foreach ($questionsRestantes as $idQuestion) {
        // Récupérer une option aléatoire pour la question
        $optionsPourQuestion = $questionsOptions[$idQuestion];
        if (empty($optionsPourQuestion)) {
            continue; // Si aucune option pour cette question, passer à la suivante
        }

        $optionText = $optionsPourQuestion[array_rand($optionsPourQuestion)]['option_text'];

        // Insérer la réponse dans la base
        $stmt = $pdo->prepare('
            INSERT INTO réponses (reponse, id_question, id_utilisateur) 
            VALUES (:reponse, :id_question, :id_utilisateur)
        ');

        $stmt->execute([
            'reponse' => $optionText, // Texte de l'option choisie
            'id_question' => $idQuestion,
            'id_utilisateur' => $idUtilisateur,
        ]);

        echo "Réponse insérée pour l'utilisateur $idUtilisateur sur la question $idQuestion avec l'option \"$optionText\".\n";
    }

    // Vérifier si toutes les questions ont une réponse pour cet utilisateur
    $questionsRestantesStmt = $pdo->prepare('
        SELECT COUNT(*) 
        FROM questions q
        LEFT JOIN réponses r ON q.id_question = r.id_question AND r.id_utilisateur = :id_utilisateur
        WHERE r.id_utilisateur IS NULL
    ');
    $questionsRestantesStmt->execute(['id_utilisateur' => $idUtilisateur]);

    if ($questionsRestantesStmt->fetchColumn() == 0) {
        // Mettre à jour l'utilisateur comme ayant participé
        $pdo->prepare('UPDATE utilisateurs SET has_participated = 1 WHERE id_utilisateur = :id_utilisateur')
            ->execute(['id_utilisateur' => $idUtilisateur]);

        echo "Utilisateur $idUtilisateur a répondu à toutes les questions.\n";
    }
}

echo "Toutes les réponses ont été insérées pour les utilisateurs disponibles.\n";
