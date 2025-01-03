<?php
require "../src/php/views/headerDash.php";
require_once "../src/php/helpers/fonction.php";
require "../src/php/config/database.php";
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
<script>
    <?php
        
// Q1        
    convertirEnJS("questionAge", $questionAge);
    convertirEnJS("dataAge", $dataAge);
    convertirEnJS("allOptionsAge", $optionAge);

    convertirEnJS("questionSex", $questionSex);
    convertirEnJS("dataSex", $dataSex);
    convertirEnJS("allOptionsSex", $optionSex);
// Q3
    convertirEnJS("questionInsertion", $questionInsertion);
    convertirEnJS("dataInsertion", $dataInsertion);
    convertirEnJS("allOptionsInsertion", $OptionInsertion);

    convertirEnJS("questionRecevez", $questionRecevez);
    convertirEnJS("dataRecevez", $dataRecevez);
    convertirEnJS("allOptionsRecevez", $OptionRecevez);
  // Q2  

    convertirEnJS("questionRegion", $questionRegion);
    convertirEnJS("dataRegion", $dataRegion);
    convertirEnJS("allOptionsRegion", $OptionRegion);
        
//    convertirEnJS("dataBesoin", $dataBesoin);
//    convertirEnJS("allOptionsBesoin", $OptionBesoin);
    ?>
</script>
<header>
    <h1>Dashboard</h1>
    <a href="index.php">Déconnexion</a>
</header>

<main>
    <!-- Première boîte avec un graphique -->
    <div class="box">
        <div class="head">
        <h2><?php echo $db->ChargerNomQuestionnaire($pdo,1 );?></h2>
        </div>
        <div class="body-box">

        <canvas id="pieChart-1"></canvas>
        <canvas id="pieChart-2"></canvas>
        </div>
    </div>

    <!-- Deuxième boîte avec un graphique -->
    <div class="box">
        <div class="head">
        <h2><?php echo $db->ChargerNomQuestionnaire($pdo,3);?></h2>
        </div>
        <div class="body-box">
        <canvas id="BarChart-1"></canvas>
        <canvas id="BarChart-2"></canvas>
        </div>
    </div>
    <div class="box">
        <div class="head">
        <h2><?php echo $db->ChargerNomQuestionnaire($pdo,2);?></h2>
        </div>
        <div class="body-box">
        <canvas id="myChart-1"></canvas>
        </div>
    </div>

</main>


<script type="module" src="./assets/js/dash.js"></script>

