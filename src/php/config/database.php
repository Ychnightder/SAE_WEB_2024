<?php
class Database
{
    private $pdo;
    private $dbHost = 'localhost';
    private $dbName = 'autisme_france';
    private $dbUser = 'root';
    private $dbPass = 'ychnightder';
    private $dbCharset = 'utf8mb4';

    private $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];
    public function connect()
    {
        if ($this->pdo === null) {
            try {
//                $dbpath = "C:\Users\Pierr\OneDrive\Bureau\SAE_WEB\src\php\config\database.db";
//                $pdo = new PDO('sqlite:' . $this->dbpath, $this->options);
                $dsn = "mysql:host={$this->dbHost};dbname={$this->dbName};charset={$this->dbCharset}";
                $this->pdo = new PDO($dsn, $this->dbUser, $this->dbPass, $this->options);
            } catch (PDOException $e) {
                die("Erreur de connexion à la base de données : " . $e->getMessage());
            }
        }
        return $this->pdo;
    }
    public function debug($d){
        echo '<pre>';
        var_dump($d);
        echo '</pre>';
    }


    public function chargerLesOptions(PDO $pdo , $idQuestion)
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





}
