<?php
require_once "../src/php/config/config.php";
use config\BDDRequetes;
require_once "../src/php/config/BDDRequetes.php";
$request = new BDDRequetes();

// Vérifiez si l'utilisateur est connecté et a le rôle 'user'
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true || $_SESSION['role'] !== 'user') {
    header('Location: /connexion.php');
    exit();
}

require "../src/php/views/headerDashUser.php";

// Initialisez les variables
$emailUser = $_SESSION['emailUser']; // Supposons que l'email de l'utilisateur est stocké dans la session
$responsesByForm = [];

$responses = $request->getReponseByUser($emailUser);

// Organiser les réponses par formulaire
foreach ($responses as $response) {
    $responsesByForm[$response['questionnaire_title']][] = [
        'question_text' => $response['question_text'],
        'option_text' => $response['option_text'],
    ];
}
?>

<header>
    <h1>Dashboard Utilisateur</h1>
    <form method="post" action="logout.php" style="display: inline;">
        <button type="submit" style="background-color: #017ac3; color: #ffffff; border: none; cursor: pointer; padding: 10px;">
            Déconnexion
        </button>
    </form>
</header>

<main>
    <div class="box">
        <h2>Enquête</h2>

        <?php if (empty($responsesByForm)): ?>
            <p>Vous n'avez pas encore répondu à l'enquête.</p>
            <a href="/enquete.php" class="link">Répondre à l'enquête</a>
        <?php else: ?>
            <p>Voici vos réponses :</p>

            <?php foreach ($responsesByForm as $formTitle => $responses): ?>
                <div class="questionnaire-box">
                    <h3><?= htmlspecialchars($formTitle) ?></h3>
                    <ul>
                        <?php foreach ($responses as $response): ?>
                            <li>
                                <strong><?= htmlspecialchars($response['question_text']) ?>:</strong>
                                <span class="option-text"><?= htmlspecialchars($response['option_text']) ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</main>
</body>
</html>
