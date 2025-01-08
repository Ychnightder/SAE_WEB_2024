<?php
namespace Pierr\SaeWeb\php\Database;
use PDO;
use PDOException;

class Database
{
        private $pdo;
    private string $dbHost = 'localhost';
    private string $dbName = 'autisme_france';
    private string $dbUser = 'root';
    private string $dbPass = 'ychnightder';
    private string $dbCharset = 'utf8mb4';
    private array $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];
    private string $dbpath = "C:\Users\Pierr\OneDrive\Bureau\SAE_WEB\src\php\config\database.db";
    public function connect() : PDO
    {
        if ($this->pdo === null) {
            try {
//                $pdo = new PDO('sqlite:' . $this->dbpath, $this->options);
                $dsn = "mysql:host={$this->dbHost};dbname={$this->dbName};charset={$this->dbCharset}";
                $this->pdo = new PDO($dsn, $this->dbUser, $this->dbPass, $this->options);
            } catch (PDOException $e) {
                die("Erreur de connexion à la base de données : " . $e->getMessage());
            }
        }
        return $this->pdo;
    }
    public function debug($d): void
    {
        echo '<pre>';
        var_dump($d);
        echo '</pre>';
    }
    public function chargerLesOptions(PDO $pdo , $idQuestion): false|array
    {
        try {
            $query = $pdo->prepare("SELECT * FROM Options WHERE id_question = :id_question");
            $query->bindValue(':id_question', $idQuestion, PDO::PARAM_INT);
            $query->execute();
            $options = $query->fetchAll();
        } catch (PDOException $e) {
            echo("Error questions: " . $e->getMessage());
        }
        return $options;
    }
    public function chargerLesQuestions(PDO $pdo): array
    {
        try {
            $questionsQuery = "SELECT Q.id_question, Q.texte_question_, Q.type_question, Q.id_questionnaire
                           FROM Questions Q
                           ";

            $stmt = $pdo->prepare($questionsQuery);
            $stmt->execute();

            $questions = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $questionId = $row['id_question'];
                if (!isset($questions[$questionId])) {
                    $questions[$questionId] = [
                        'id_question' => $row['id_question'],
                        'texte_question' => $row['texte_question_'],
                        'type_question' => $row['type_question'],
                        'id_questionnaire' => $row['id_questionnaire'],
                    ];
                }
            }

            return $questions;

        } catch (PDOException $e) {
            echo "Erreur lors du chargement des questions : " . $e->getMessage();
            return [];
        }
    }
    public function chargerReponse (PDO $pdo ,  $idQuestion ): false|array
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
    public function ChargerNomQuestionnaire(PDO $pdo,  $idQuestionnaire )
    {
        $query = "
    SELECT titre_ 
    FROM questionnaires q
    WHERE q.id_questionnaire = :idQuestionnaire
";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':idQuestionnaire', $idQuestionnaire ,pdo::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data[0]["titre_"];
    }
    public function ChargerTexteQuestion(PDO $pdo,  $idQuestion )
    {
        $query = "
    SELECT texte_question_
    FROM questions q
    WHERE q.id_question = :idQuestion
";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':idQuestion', $idQuestion ,pdo::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data[0]["texte_question_"];
    }

    function getReponseByUser($emailUser): array {
        $query = $this->pdo->prepare("
            SELECT q.texte_question_ AS question_text, o.option_text, qn.titre_ AS questionnaire_title
            FROM Reponses r
            INNER JOIN Questions q ON r.id_question = q.id_question
            INNER JOIN Options o ON r.id_option = o.id_option
            INNER JOIN Questionnaires qn ON q.id_questionnaire = qn.id_questionnaire
            WHERE r.emailUser = :emailUser
        ");
        $query->bindParam(':emailUser', $emailUser, PDO::PARAM_STR);
        $query->execute();
        return $query->fetchAll();
    }


}
