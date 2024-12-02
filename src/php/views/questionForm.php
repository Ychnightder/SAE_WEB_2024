<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Formulaire Étape <?= $step ?></title>
    <style>
        .selected {
            background-color: #007bff;
            color: #fff;
            border: 2px solid #0056b3;
        }
    </style>

</head>
<body>
<script>
    function selectOption(button) {
        // Récupérer l'ID de l'input depuis le bouton
        const inputId = button.getAttribute('data-target');
        const hiddenInput = document.getElementById(inputId);

        // Mettre à jour la valeur de l'input caché
        hiddenInput.value = button.value;

        // Optionnel : Changer l'apparence du bouton sélectionné
        const buttons = document.querySelectorAll(`[data-target="${inputId}"]`);
        buttons.forEach(btn => btn.classList.remove('selected'));
        button.classList.add('selected');
    }
</script>

<div class="container">
    <h1>Étape <?= $step ?> sur <?= $totalSteps ?></h1>
    <form action="enquete.php?step=<?= $step ?>" method="post">
        <input type="hidden" name="step" value="<?= $step ?>">

        <?php foreach ($questions as $index => $question): ?>
            <div class="question">
                <p>
                    <strong>
                        Question <?= $index + 1 ?> : <?= htmlspecialchars($question['texte_question_']) ?>
                    </strong>
                </p>

                <?php if ($question['type_question'] === 'button'): ?>
                    <?php
                    // Charger les options pour cette question de type 'button'
                    $query = $pdo->prepare("SELECT * FROM Options WHERE id_question = :id_question");
                    $query->execute(['id_question' => $question['id_question']]);
                    $options = $query->fetchAll();
                    ?>

                    <?php foreach ($options as $option): ?>
                        <button type="button"
                                onclick="selectOption(this)"
                                data-target="input-<?= $question['id_question'] ?>"
                                value="<?= $option['option_text'] ?>">

                            <?= htmlspecialchars($option['option_text']) ?>
                        </button>
                         <!-- hidden -->
                    <?php endforeach; ?>
                    <input type="text"
                           id="input-<?= $question['id_question'] ?>"
                           name="reponses[<?= $question['id_question'] ?>]"
                           value="">

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