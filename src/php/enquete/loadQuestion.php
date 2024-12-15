<?php

function loadQuestions($pdo, $step) {
    $query = $pdo->prepare("
        SELECT Questions.texte_question_, Questions.type_question, Questions.id_question
        FROM Questions
        INNER JOIN Questionnaires ON Questions.id_questionnaire = Questionnaires.id_questionnaire
        WHERE Questionnaires.id_questionnaire = :step
    ");
    $query->execute(['step' => $step]);
    return $query->fetchAll();
}
