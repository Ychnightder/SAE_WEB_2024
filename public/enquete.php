<?php
global $pdo;
require_once '../src/php/config/database.php';
require_once '../src/php/helpers/fonction.php';
$step = isset($_GET['step']) ? (int) $_GET['step'] : 1;
$query = $pdo->prepare("SELECT COUNT(*) as total FROM Questionnaires");
$query->execute();
$totalSteps = (int) $query->fetch()['total'];

// Si l'étape est invalide, terminer le script
if ($step < 1 || $step > $totalSteps) {
    die("Étape invalide.");
}

// Charger les questions pour l'étape actuelle
$query = $pdo->prepare("
    SELECT Questions.texte_question_, Questions.type_question, Questions.id_question
    FROM Questions
    INNER JOIN Questionnaires ON Questions.id_questionnaire = Questionnaires.id_questionnaire
    WHERE Questionnaires.id_questionnaire = :step   
");
$query->execute(['step' => $step]);
$questions = $query->fetchAll();

// Si aucune question n'est trouvée, afficher une erreur
if (!$questions) {
    die("Aucune question pour cette étape.");
}

// Traitement de la soumission du formulaire (enregistrement des réponses)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reponses = $_POST['reponses'] ?? [];

    foreach ($reponses as $id_question => $reponse) {
        $query = $pdo->prepare("
            INSERT INTO Réponses (reponse, id_question, id_utilisateur)
            VALUES (:reponse, :id_question, :id_utilisateur)
            ON DUPLICATE KEY UPDATE reponse = :reponse
        ");
        $query->execute([
            'reponse' => $reponse,
            'id_question' => $id_question,
            'id_utilisateur' => 1 // Utilisateur connecté (à modifier selon ton système d'authentification)
        ]);
    }

    // Rediriger vers l'étape suivante ou vers la page finale
    $nextStep = $step + 1;
    if ($nextStep > $totalSteps) {
        header("Location: https://www.google.fr/");
    } else {
        header("Location: enquete.php?step=$nextStep");
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Formulaire Étape <?= $step ?></title>
</head>
<body>
<div class="container">
    <h1>Étape <?= $step ?> sur <?= $totalSteps ?></h1>

    <form action="enquete.php?step=<?= $step ?>" method="post">
        <input type="hidden" name="step" value="<?= $step ?>">

        <?php foreach ($questions as $index => $question): ?>
            <div class="question">
                <p><strong>Question <?= $index + 1 ?> : <?= htmlspecialchars($question['texte_question_']) ?></strong></p>

                <?php if ($question['type_question'] === 'button'): ?>
                    <?php
                    // Charger les options pour cette question de type 'button'
                    $query = $pdo->prepare("SELECT * FROM Options WHERE id_question = :id_question");
                    $query->execute(['id_question' => $question['id_question']]);
                    $options = $query->fetchAll();
                    ?>

                    <?php foreach ($options as $option): ?>
                        <button type="button" name="reponses[<?= $question['id_question'] ?>]" value="<?= $option['option_text'] ?>" required>
                            <?= htmlspecialchars($option['option_text']) ?>
                        </button>
                    <?php endforeach; ?>
                <?php elseif ($question['type_question'] === 'textarea'): ?>
                    <textarea name="reponses[<?= $question['id_question'] ?>]" required></textarea>
                <?php elseif ($question['type_question'] === 'select'): ?>
                    <?php
                    // Charger les options pour cette question de type 'select'
                    $query = $pdo->prepare("SELECT * FROM Options WHERE id_question = :id_question");
                    $query->execute(['id_question' => $question['id_question']]);
                    $options = $query->fetchAll();
                    ?>

                    <select name="reponses[<?= $question['id_question'] ?>]" required>
                        <?php foreach ($options as $option): ?>
                            <option value="<?= htmlspecialchars($option['option_text']) ?>"><?= htmlspecialchars($option['option_text']) ?></option>
                        <?php endforeach; ?>
                    </select>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>

        <div class="navigation">
            <?php if ($step > 1): ?>
                <a href="enquete.php?step=<?= $step - 1 ?>" class="btn">Précédent</a>
            <?php endif; ?>
            <button type="submit" class="btn">Suivant</button>
        </div>
    </form>
</div>
</body>
</html>
