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
                $dsn = "mysql:host={$this->dbHost};dbname={$this->dbName};charset={$this->dbCharset}";
                $this->pdo = new PDO($dsn, $this->dbUser, $this->dbPass, $this->options);
            } catch (PDOException $e) {
                die("Erreur de connexion à la base de données : " . $e->getMessage());
            }
        }
        return $this->pdo;
    }
}
