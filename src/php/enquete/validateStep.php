<?php
function getTotalSteps($pdo) {
    $query = $pdo->prepare("SELECT COUNT(*) as total FROM Questionnaires");
    $query->execute();
    $totalSteps = (int) $query->fetch()['total'];

    // Limiter à 7 étapes
    return min($totalSteps, 7);
}

function validateStep($step, $totalSteps) {
    if ($step < 1 || $step > $totalSteps) {
        header("Location: enquete.php?step=1");
    }
}