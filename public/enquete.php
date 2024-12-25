<?php


global $pdo;
require_once '../src/php/config/database.php';
require_once '../src/php/helpers/fonction.php';
require_once '../src/php/enquete/validateStep.php';
require_once '../src/php/enquete/loadQuestion.php';
require_once '../src/php/enquete/handlePost.php';



$step = isset($_GET['step']) ? (int)$_GET['step'] : 1;

$totalSteps = getTotalSteps($pdo);

validateStep($step, $totalSteps);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    handlePostRequest($pdo, $_POST, $step, $totalSteps);
}

// Charger les questions pour l'étape actuelle
$questions = loadQuestions($pdo, $step);

extract([
    'step' => $step,
    'totalSteps' => $totalSteps,
    'questions' => $questions,
]);

// Inclure le formulaire
require_once '../src/php/views/questionForm.php';

