<?php
require_once __DIR__ . '/../config/database.php';
$db = new Database();
$pdo = $db->connect();

function chargerReponse ($pdo , $idQuestion )
{
    $query = "
    SELECT r.reponse, COUNT(*) as count 
    FROM réponses r
    JOIN questions q ON r.id_question = q.id_question
    WHERE q.id_question = :idQuestion
    GROUP BY r.reponse
";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':idQuestion', $idQuestion ,pdo::PARAM_INT);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $data;
}


$ageData = chargerReponse($pdo , 1);

echo '<pre>';
var_dump($ageData );
echo '</pre>';







