<?php

require_once "../src/php/config/config.php";
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true || $_SESSION['role'] !== 'user') {
    // Redirigez vers la page de connexion ou affichez un message d'erreur
    header('Location: /connexion.php'); // Remplacez "login.php" par votre page de connexion
    exit();
}
use config\BDDRequetes;
require_once '../src/php/config/BDDRequetes.php';
require_once '../src/php/helpers/fonction.php';
require_once '../src/php/enquete/stepQuestionnaire.php';
require_once '../src/php/enquete/handlePost.php';


$request = new BDDRequetes();
$pdo = $request->pdo;

$step = isset($_GET['step']) ? (int)$_GET['step'] : 1;

$totalSteps = getTotalSteps($pdo);

validateStep($step, $totalSteps);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    handlePostRequest($pdo, $_POST, $step, $totalSteps);
}

$questions = $request->loadQuestions($step);


extract([
    'step' => $step,
    'totalSteps' => $totalSteps,
    'questions' => $questions,
]);


// Inclure le formulaire
require_once '../src/php/views/questionForm.php';


