<?php
//function handlePostRequest($pdo, $postData, $step, $totalSteps) {
//    $reponses = $postData['reponses'] ?? [];
//
//    foreach ($reponses as $id_question => $reponse) {
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
//
//    $nextStep = $step + 1;
//    if ($nextStep === $totalSteps) {
//        header("Location: https://www.google.fr/");
//    } else {
//        header("Location: enquete.php?step=$nextStep");
//    }
//    exit;
//}


function handlePostRequest($pdo, $postData, $step, $totalSteps) {
    $reponses = $postData['reponses'] ?? [];

    // Charger les questions pour l'étape actuelle
    $questions = loadQuestions($pdo, $step);
    $missingResponses = [];

    // Vérifier que chaque question a une réponse
    foreach ($questions as $question) {
        $id_question = $question['id_question'];
        if (empty($reponses[$id_question])) {
            $missingResponses[] = $question['texte_question_'];
        }
    }

    if (!empty($missingResponses)) {
        // Affiche un message d'erreur ou redirige avec un message
        header("Location: enquete.php?step=$step&error=missing");
        exit;
    }

    // Sauvegarder les réponses
    foreach ($reponses as $id_question => $reponse) {
        $query = $pdo->prepare("
            INSERT INTO Réponses (reponse, id_question, id_utilisateur)
            VALUES (:reponse, :id_question, :id_utilisateur)
            ON DUPLICATE KEY UPDATE reponse = :reponse
        ");
        $query->execute([
            'reponse' => $reponse,
            'id_question' => $id_question,
            'id_utilisateur' => 1 // ID utilisateur (fixe pour l'instant)
        ]);
    }

    // Aller à l'étape suivante
    $nextStep = $step + 1;
    if ($nextStep > $totalSteps) {
        header("Location: https://www.google.fr/");
    } else {
        header("Location: enquete.php?step=$nextStep");
    }
    exit;
}
