<?php

require_once '../src/php/config/BDDRequetes.php';
require_once '../src/php/helpers/fonction.php';
require_once '../src/php/enquete/stepQuestionnaire.php';
//require_once '../src/php/enquete/loadQuestion.php';
require_once '../src/php/enquete/handlePost.php';
use config\BDDRequetes;


$request = new BDDRequetes();
$pdo = $request->pdo;

$step = isset($_GET['step']) ? (int)$_GET['step'] : 1;

$totalSteps = getTotalSteps($pdo);

validateStep($step, $totalSteps);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    handlePostRequest($pdo, $_POST, $step, $totalSteps);
}

// Charger les questions pour l'étape actuelle
try {
    $questions = $request->loadQuestions($step);
} catch (Exception $e) {
    echo $e->getMessage();
}

extract([
    'step' => $step,
    'totalSteps' => $totalSteps,
    'questions' => $questions,
]);

// Inclure le formulaire
require_once '../src/php/views/questionForm.php';

