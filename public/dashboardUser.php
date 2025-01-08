<?php
session_start();
require_once "../src/php/views/headerDashUser.php";
require_once "../src/php/helpers/fonction.php";
require_once "../vendor/autoload.php";
use Pierr\SaeWeb\php\Database\Database;
if (!isset($_SESSION["userCurrent"])) {
    header("Location: /connexion.php"); // Rediriger si non connecté
    exit();
}

$db = new Database();
$pdo = $db->connect();

$id_utilisateur = $_SESSION["userCurrent"]['id'];
$reponse = $db->getReponseByUser($pdo, $id_utilisateur);
$reponseByForm = [];

foreach ($responses as $response) {
    $responsesByForm[$response['questionnaire_title']][] = [
        'question_text' => $response['question_text'],
        'option_text' => $response['option_text'],
    ];
}

?>

<header>
    <h1><?php echo$_SESSION['userCurrent']['prenom'] . " " . substr($_SESSION['userCurrent']['nom'], 0, 1) . "."?></h1>
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
            <a href="main.php" class="link">Répondre à l'enquête</a>
        <?php else: ?>
            <p>Voici vos réponses :</p>

            <?php foreach ($responsesByForm as $formTitle => $reponse): ?>
                <div class="questionnaire-box">
                    <h3><?= htmlspecialchars($formTitle) ?></h3>
                    <ul>
                        <?php foreach ($reponse as $r): ?>
                            <li>
                                <strong><?= htmlspecialchars($r['question_text']) ?>:</strong>
                                <span class="option-text"><?= htmlspecialchars($r['option_text']) ?></span>
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
