<?php
require_once __DIR__ . '/../config/database.php';
$db = new Database();
$pdo = $db->connect();

$ageData = $db->ChargerNomQuestionnaire($pdo , 1);

echo '<pre>';
var_dump($ageData[0]["titre_"] );
echo '</pre>';







