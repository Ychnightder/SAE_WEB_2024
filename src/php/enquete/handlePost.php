<?php

function handlePostRequest($pdo, $postData, $step, $totalSteps) {
    $reponses = $postData['reponses'] ?? [];
    debug($reponses);
//    foreach ($reponses as $id_question => $reponse) {
//
//
//        $query = $pdo->prepare("
//            INSERT INTO Réponses (reponse, id_question, id_utilisateur)
//            VALUES (:reponse, :id_question, :id_utilisateur)
//            ON DUPLICATE KEY UPDATE reponse = :reponse
//        ");
//        $query->execute([
//            'reponse' => $reponse,
//            'id_question' => $id_question,
//            'id_utilisateur' => 1 // Utilisateur connecté
//        ]);
//    }

//    $nextStep = $step + 1;
//    if ($nextStep > $totalSteps) {
//        header("Location: https://www.google.fr/");
//    } else {
//        header("Location: enquete.php?step=$nextStep");
//    }
//    exit;
}