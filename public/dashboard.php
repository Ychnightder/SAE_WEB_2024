<?php
session_start();
require "../src/php/views/headerDash.php";
use Pierr\SaeWeb\php\Database\Database;
require_once "../src/php/helpers/fonction.php";
require  '../vendor/autoload.php';
$db = new Database();
$pdo = $db->connect();

// Q1
$questionAge = $db->ChargerTexteQuestion($pdo,1);
$dataAge = $db->chargerReponse($pdo,1);
$optionAge = $db->chargerLesOptions($pdo,1);

$questionSex= $db->ChargerTexteQuestion($pdo,2);
$dataSex = $db->chargerReponse($pdo,2);
$optionSex = $db->chargerLesOptions($pdo,2);

//Q3
$questionInsertion = $db->ChargerTexteQuestion($pdo,9);
$dataInsertion = $db->chargerReponse($pdo,9);
$OptionInsertion = $db->chargerLesOptions($pdo,9);

$questionRecevez = $db->ChargerTexteQuestion($pdo,9);
$dataRecevez  = $db->chargerReponse($pdo,9);
$OptionRecevez  = $db->chargerLesOptions($pdo,9);

//Q2

$questionRegion = $db->ChargerTexteQuestion($pdo,5);
$dataRegion = $db->chargerReponse($pdo,5);
$OptionRegion = $db->chargerLesOptions($pdo,5);


?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script defer>
    <?php
//// Q1
//    convertirEnJS("questionAge", $questionAge);
//    convertirEnJS("dataAge", $dataAge);
//    convertirEnJS("allOptionsAge", $optionAge);
//
//    convertirEnJS("questionSex", $questionSex);
//    convertirEnJS("dataSex", $dataSex);
//    convertirEnJS("allOptionsSex", $optionSex);
//// Q3
//    convertirEnJS("questionInsertion", $questionInsertion);
//    convertirEnJS("dataInsertion", $dataInsertion);
//    convertirEnJS("allOptionsInsertion", $OptionInsertion);
//
//    convertirEnJS("questionRecevez", $questionRecevez);
//    convertirEnJS("dataRecevez", $dataRecevez);
//    convertirEnJS("allOptionsRecevez", $OptionRecevez);
//  // Q2
//
//    convertirEnJS("questionRegion", $questionRegion);
//    convertirEnJS("dataRegion", $dataRegion);
//    convertirEnJS("allOptionsRegion", $OptionRegion);

    ?>
</script>
<header>
  <div class="logo">
      <h1>Dashboard</h1>
  </div>
    <div class="filtre">
        <form action="dashboard.php" method="get">
            <div class="box" id="questionBox">
                <label for="questionSelect" >Sélectionner une Question</label>
                <select id="questionSelect" name="question_id" onchange="this.form.submit()">
                    <option value="">Choisir une question</option>
                    <?php
                    // Récupérer les questions en fonction du questionnaire sélectionné
                    $questions = $db->chargerLesQuestions($pdo);
                    foreach ($questions as $question) {
                        if($question['type_question'] !== "textarea") {
                            echo "<option value='{$question['id_question']}' name='id_question{$question['id_question']}'>{$question['texte_question']}</option>";
                        }
                    }
                    ?>
                </select>
            </div>
        </form>
    </div>
    <div class="logout">
        <a href="index.php">Déconnexion</a>
    </div>
</header>

<main>
    <?php if (isset($_GET['question_id']) && $_GET['question_id'] != ''): ?>
        <p><?php echo $db->ChargerTexteQuestion($pdo, $_GET['question_id'])?></p>
        <div class="box" id="graphButtons" >
            <h2>Choisir le Type de Graphique</h2>
            <script>
                <?php
                    $question = $db->ChargerTexteQuestion($pdo,$_GET['question_id']);
                    $data = $db->chargerReponse($pdo,$_GET['question_id']);
                    $option = $db->chargerLesOptions($pdo,$_GET['question_id']);
                    convertirEnJS("question", $question);
                    convertirEnJS("data", $data);
                    convertirEnJS("allOptions", $option);
                ?>
            </script>

            <button type="button" onclick="generateChart("pie-chart", allOptions, data, "pie", question)">Graphique Camembert</button>
<!--            <button type="button" onclick="generateChart(<?php //echo $_GET['question_id']?>//)">Graphique en Barres</button>
            <button type="button" onclick="generateChart(<?php //echo $_GET['question_id']?>//)">Graphique Camembert + Barres</button> -->
        </div>
    <?php endif; ?>
    <canva id="pie-chart" ></canva>
    <canva id="bar-chart"></canva>
    <canva id="doughnut-chart"></canva>
</main>

<script type="module" src="./assets/js/dash.js"></script>
