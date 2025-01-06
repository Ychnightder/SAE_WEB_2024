<?php
session_start();
require "../src/php/views/headerDash.php";
use Pierr\SaeWeb\php\Database\Database;
require_once "../src/php/helpers/fonction.php";
require  '../vendor/autoload.php';
$db = new Database();
$pdo = $db->connect();
$questions = $db->chargerLesQuestions($pdo);

// Charger toutes les questions pour le menu déroulant
$questions = $db->chargerLesQuestions($pdo);

// Vérifier si une question est sélectionnée
$questionId = isset($_GET['question_id']) ? intval($_GET['question_id']) : null;
$questionText = null;
$options = [];
$responses = [];

if ($questionId) {
    $questionText = $db->ChargerTexteQuestion($pdo, $questionId);
    $options = $db->chargerLesOptions($pdo, $questionId);
    $responses = $db->chargerReponse($pdo, $questionId);
}

?>
<script>

    function generateChart(canvasId, allOptions, rawData, chartType, question) {
        const canvas = document.getElementById(canvasId);
        if (!canvas) return;

        // Prépare les données pour le graphique
        const mergedData = allOptions.map((option) => {
            const match = rawData.find((data) => data.reponse === option.option_text);
            return { reponse: option.option_text, count: match ? match.count : 0 };
        });

        const labels = mergedData.map((item) => item.reponse);
        const data = mergedData.map((item) => item.count);

        const ctx = canvas.getContext("2d");
        new Chart(ctx, {
            type: chartType,
            data: {
                labels: labels,
                datasets: [
                    {
                        label: "Nombre de réponses",
                        data: data,
                        backgroundColor: [
                            "#FF6384",
                            "#36A2EB",
                            "#FFCE56",
                            "#4BC0C0",
                            "#9966FF",
                            "#FF9F40",
                            "#E7E9ED",
                        ],
                        borderColor: "#ccc",
                        borderWidth: 1,
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: chartType !== "bar",
                    },
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                return `${context.label}: ${context.raw}`;
                            },
                        },
                    },
                },
                scales: chartType === "bar" ? {
                    y: {
                        beginAtZero: true,
                        title: { display: true, text: "Nombre de réponses" },
                    },
                    x: {
                        title: { display: true, text: "Catégories" },
                    },
                } : {},
            },
        });
    }

    console.log("Script chargé : generateChart disponible ?", typeof generateChart === "function");

    <?php if ($questionId): ?>
    // Transmettre les données PHP au JavaScript
    const question = <?php echo json_encode($questionText); ?>;
    const allOptions = <?php echo json_encode($options); ?>;
    const data = <?php echo json_encode($responses); ?>;
    <?php else: ?>
    // Valeurs par défaut si aucune question n'est sélectionnée
    const question = null;
    const allOptions = [];
    const data = [];
    <?php endif; ?>
</script>

<header>
  <div class="logo">
      <h1>Dashboard</h1>
  </div>
    <div class="filtre">
        <form action="dashboard.php" method="get">
            <div class="box" id="questionBox">
                <label for="questionSelect">Sélectionner une Question</label>
                <select id="questionSelect" name="question_id" onchange="this.form.submit()">
                    <option value="">Choisir une question</option>
                    <?php foreach ($questions as $question): ?>
                        <?php if ($question['type_question'] !== "textarea"): ?>
                            <option value="<?php echo $question['id_question']; ?>" <?php echo $questionId == $question['id_question'] ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($question['texte_question']); ?>
                            </option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>
        </form>
    </div>
    <div class="logout">
        <a href="index.php">Déconnexion</a>
    </div>
</header>

<main>
    <?php if ($questionId): ?>
        <h2><?php echo htmlspecialchars($questionText); ?></h2>
        <div class="box" id="graphButtons">
            <h3>Choisir le Type de Graphique</h3>
            <button type="button" onclick="generateChart('pie-chart', allOptions, data, 'pie', question)">Graphique Camembert</button>
            <button type="button" onclick="generateChart('bar-chart', allOptions, data, 'bar', question)">Graphique en Barres</button>
            <button type="button" onclick="generateChart('doughnut-chart', allOptions, data, 'doughnut', question)">Graphique Doughnut</button>
        </div>
        <canvas id="pie-chart"></canvas>
        <canvas id="bar-chart"></canvas>
        <canvas id="doughnut-chart"></canvas>
    <?php else: ?>
        <p>Veuillez sélectionner une question pour afficher un graphique.</p>
    <?php endif; ?>
</main>

<script type="module" src="./assets/js/dash.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

