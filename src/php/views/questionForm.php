<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Formulaire Enquête <?= $step ?></title>
    <link rel="stylesheet" href="./assets/css/questionForm.css">
    <link rel="stylesheet" href="./assets/css/main.css">
    <script src="./assets/js/questionForm.js" defer></script>
</head>
<body>
<div class="container">
    <div class="header-form">
        <h1 class="stepbystep"><?= $step ?> sur <?= $totalSteps ?></h1>
        <div class="progress-bar">
            <?php for ($i = 1; $i <= $totalSteps; $i++): ?>
                    <div class="<?= $i <= $step ? 'active' : '' ?>"></div>
            <?php endfor; ?>
        </div>
    </div>


    <form class="form" action="enquete.php?step=<?= $step ?>" method="post" data-next-step="<?= $step + 1 ?>">
        <input type="hidden" name="step" value="<?= $step ?>">
        <div id="questions-wrapper">
        <?php foreach ($questions as $index => $question): ?>
            <div class="question-slide <?= $index === 0 ? 'visible' : '' ?>" id="question-<?= $index ?>">
                <p class="question-num">
                    Question <?= $index + 1 ?>
                </p>
                <p class="question">
                   <?= htmlspecialchars($question['texte_question_'])?>
                </p>
                <div class="div-reponse">
                    <?php if ($question['type_question'] === 'button'): ?>
                    <?php
                    // Charger les options pour cette question de type 'button'
                    $query = $pdo->prepare("SELECT * FROM Options WHERE id_question = :id_question");
                    $query->execute(['id_question' => $question['id_question']]);
                    $options = $query->fetchAll();
                    ?>

                    <?php foreach ($options as $option): ?>
                        <button class="btn-select" type="button"
                                onclick="selectOption(this)"
                                data-target="input-<?= $question['id_question'] ?>"
                                value="<?= $option['option_text'] ?>">

                            <?= htmlspecialchars($option['option_text']) ?>
                        </button>
                    <?php endforeach; ?>
                        <!-- hidden -->
                    <input type="hidden"
                           id="input-<?= $question['id_question'] ?>"
                           name="reponses[<?= $question['id_question'] ?>]"
                           value="">

                <?php elseif ($question['type_question'] === 'textarea'): ?>
                    <textarea placeholder="champs libre" name="reponses[<?= $question['id_question'] ?>]" required></textarea>
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
            </div>
        <?php endforeach; ?>
        </div>
        <div class="navigation">

            <button id="prev-btn" type="button" class="btn">Retour</button>
            <button id="next-btn" type="button" class="btn">Suivant</button>
        </div>
    </form>
</div>

</body>
</html>