<?php

class BDDConnect {
    private string $dbpath;
    public PDO $pdo;
    public function __construct(string $dbpath) {
        $this->dbpath = $dbpath;
    }

    public function connexion() : PDO {
        try {
            $pdo = new PDO('sqlite:' . $this->dbpath);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
        return $this->pdo;
    }

}