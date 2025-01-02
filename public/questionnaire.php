<?php
session_start();

require_once "../src/php/helpers/fonction.php";
require "../src/php/config/database.php";

if (!isset($_SESSION["userCurrent"])) {
    header("Location: ./index.php?action=connect_user"); // Rediriger si non connecté
    exit();
}
$totalQuestionnaire = 7;
$db = new Database();
$pdo = $db->connect();
$questions = $db->chargerLesQuestions($pdo);
$step = 1; // Par défaut
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Questionnaire</title>
    <link rel="stylesheet" href="./assets/css/questionForm.css">
    <link rel="stylesheet" href="./assets/css/main.css">
    <script src="./assets/js/questionForm.js" defer></script>
</head>
<body >
    <div class="container">
        <div class="header-form">
            <h1 class="stepbystep"><?= $step ?> sur 7</h1>
            <div class="progress-bar">
                <?php for ($i = 1; $i <= $totalQuestionnaire; $i++): ?>
                    <div class="<?= $i <= $step ? 'active' : '' ?>"></div>
                <?php endfor; ?>
            </div>
        </div>
    <form class="form" method="POST" action="index.php?action=submit_form">
        <div id="questions-wrapper">
            <?php foreach ($questions as $index => $question): ?>
            <div class="question-slide <?= $index === 0 ? 'visible' : '' ?>" id="question-<?= $index ?>" data-id="<?= $question['id_questionnaire']  ?>">
                <p class="question-num">
                    Question <?= $index  ?>
                </p>
                <p class="question">
                    <?= htmlspecialchars($question['texte_question'])?>
                </p>

                <div class="div-reponse">
                        <?php if ($question['type_question'] === 'button'): ?>
                        <?php
                        $options = $db->chargerLesOptions($pdo , $question['id_question']);
                            ?>
                            <?php foreach ($options as $option): ?>
                                <button class="btn-select" type="button"
                                        onclick="selectOption(this)"
                                        data-target="input-<?= $question['id_question'] ?>"
                                        value="<?= $option['option_text'] ?>">

                                    <?= htmlspecialchars($option['option_text']) ?>
                                </button>
                            <?php endforeach; ?>
                            <input type="hidden"
                                   id="input-<?= $question['id_question'] ?>"
                                   name="reponses[<?= $question['id_question'] ?>]"
                                   value="" readonly required>


                        <?php elseif ($question['type_question'] === 'textarea'): ?>
                            <textarea placeholder="champs libre" name="reponses[<?= $question['id_question'] ?>]" required></textarea>

                        <?php elseif ($question['type_question'] === 'select'): ?>
                        <?php $options = $db->chargerLesOptions($pdo , $question['id_question']);
                            ?>
                            <select name="reponses[<?= $question['id_question'] ?>]" required>
                                <?php foreach ($options as $option): ?>
                                    <option  value="<?= htmlspecialchars($option['option_text']) ?>"><?= htmlspecialchars($option['option_text']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="navigation">
            <button id="prev-btn" type="button" class="btn">Retour</button>
            <button id="next-btn" type="button" class="btn">Suivant</button>
        </div>
    </form>
</div>
