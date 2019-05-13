<?php

class Database
{
    private $host = "localhost";
    private $userName = "root";
    private $password = "";
    private $dbName = "music";
    public $pdo;

    // get the database connection
    public function getConnection(): PDO
    {
        $this->pdo = null;
        try {
            $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->dbName;
            $this->pdo = new PDO($dsn, $this->userName, $this->password);

        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->pdo;
    }
}
