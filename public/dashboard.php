<?php
require_once "../src/php/config/config.php";

use config\BDDRequetes;
require_once "../src/php/config/BDDRequetes.php";
$request = new BDDRequetes();
// Vérifiez si l'utilisateur est connecté et est admin
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true || $_SESSION['role'] !== 'admin') {
    // Redirigez vers la page de connexion ou affichez un message d'erreur
    header('Location: /connexion.php'); // Remplacez "login.php" par votre page de connexion
    exit();
}

require "../src/php/views/headerDash.php";

?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<header>
    <h1>Dashboard Administrateur</h1>
    <h3>
        <a href="change_passwordAdmin.php">Modifier un mot de passe</a>
    </h3>
    <form method="post" action="logout.php" style="display: inline;">
        <button type="submit" style="background-color: #017ac3; color: #ffffff; border: none; cursor: pointer; padding: 10px;">
            Déconnexion
        </button>
    </form>
</header>

<main class="dashboard-main">
    <!-- Sélection du questionnaire -->
    <form method="POST" action="dashboard.php">
        <div class="box">
            <h2>Sélectionner un Questionnaire</h2>
            <select id="questionnaireSelect" name="questionnaire_id" onchange="this.form.submit()">
                <option value="">Choisir un questionnaire</option>
                <?php
                $questionnaires = $request->getAllQuestionnaires();
                foreach ($questionnaires as $questionnaire) {
                    // Vérifie si c'est déjà le questionnaire sélectionné pour le maintenir dans la liste
                    $selected = (isset($_POST['questionnaire_id']) && $_POST['questionnaire_id'] == $questionnaire['id_questionnaire']) ? 'selected' : '';
                    echo "<option value='{$questionnaire['id_questionnaire']}' {$selected}>{$questionnaire['titre_']}</option>";
                }
                ?>
            </select>
        </div>
    </form>

    <!-- Sélection de la question, initialement cachée -->
    <?php if (isset($_POST['questionnaire_id']) && $_POST['questionnaire_id'] != ''): ?>
        <div class="box" id="questionBox">
            <h2>Sélectionner une Question</h2>
            <select id="questionSelect" onchange="showGraphButtons()">
                <option value="">Choisir une question</option>
                <?php
                // Récupérer les questions en fonction du questionnaire sélectionné
                $questions = $request->getAllQuestionForQuestionnaire($_POST['questionnaire_id']);
                foreach ($questions as $question) {
                    echo "<option value='{$question['id_question']}'>{$question['texte_question_']}</option>";
                }
                ?>
            </select>
        </div>
    <?php endif; ?>

    <!-- Choix du graphique, initialement caché -->
    <div class="box" id="graphButtons" style="display: none;">
        <h2>Choisir le Type de Graphique</h2>
        <?php
        $label = $request->getOptions(1);
        $reponse = $request->getReponse(1);
        $labelJson = json_encode($label);
        $reponseJson = json_encode($reponse);
        ?>
        <button type="button" onclick="generatePieChart(<?php echo $labelJson; ?>, <?php echo $reponseJson; ?>)">Graphique Camembert</button>
        <button type="button" onclick="generateBarChart()">Graphique en Barres</button>
        <button type="button" onclick="generateBoth()">Graphique Camembert + Barres</button>
    </div>

    <!-- Graphiques Camembert-->
    <div class="box" id="graphBoxPie" style="display: none;">
        <h2>Graphique Camembert</h2>
        <canvas id="pie-chart"></canvas>
    </div>

    <!-- Graphiques Barres-->
    <div class="box" id="graphBoxBar" style="display: none;">
        <h2>Graphique en Barres</h2>
        <canvas id="bar-chart"></canvas>
    </div>
</main>



</html>
