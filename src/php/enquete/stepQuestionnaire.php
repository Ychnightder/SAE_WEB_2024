<?php


function validateStep($step, $totalSteps) {
    if ($step < 1 || $step > $totalSteps) {
        die("Étape invalide.");
    }
}