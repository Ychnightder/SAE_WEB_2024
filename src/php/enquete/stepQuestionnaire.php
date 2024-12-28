<?php
function getTotalSteps($pdo) {
    $query = $pdo->prepare("SELECT COUNT(*) as total FROM Questionnaires");
    $query->execute();
    return (int) $query->fetch()['total'];
}

function validateStep($step, $totalSteps) {
    if ($step < 1 || $step > $totalSteps) {
        die("Étape invalide.");
    }
}