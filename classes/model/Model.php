<?php 


abstract class Model
{
    private string $host;
    private string $dbname;
    protected PDO $pdo;

    public function __construct()
    {
        $this->host = 'localhost:3306';
        $this->dbname = 'produit';

        $this->pdo = $this->connection();
    }   

    /**
     * Database connection
     */
    protected function connection(): PDO
    {
        $dsn = "mysql:host=$this->host;dbname=$this->dbname";
        $username = "root";
        $password = "";

        return new PDO($dsn, $username, $password, [PDO::FETCH_OBJ]);
    }
}

