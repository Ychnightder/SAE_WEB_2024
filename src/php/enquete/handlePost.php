<?php

$errors = [];

function handlePostRequest($request, $postData, $step, $totalSteps) {
    $dataReponse = $postData['reponses'] ?? [];
    foreach ($dataReponse as $id_question => $reponse) {
        $id_option = $request->getOptionIdByText($reponse);
        debug($id_option);
        debug($reponse);
        $result = $request->insertReponse($id_option, $id_question, $_SESSION['emailUser']);
        if (!$result) {
            $errors['insert_fail'] = "Une erreur est survenue. Veuillez recommencer l'enquête. Si le problème persiste, contactez l'administrateur.";
            $_SESSION['insert_error'] = $errors;
            header("Location: enquete.php?step=$step");
            exit;
        }
    }
    $nextStep = $step + 1;
    if ($nextStep > $totalSteps) {
        header("Location: https://www.google.fr/");
    } else {
        header("Location: enquete.php?step=$nextStep");
    }
    exit;
}