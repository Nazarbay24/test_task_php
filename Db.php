<?php

class Db
{
    private $pdo;
    private $host;
    private $user;
    private $password;
    private $dbname;

    public function __construct()
    {
        $this->host = "localhost";
        $this->user = "root";
        $this->password = "";
        $this->dbname = "php_ss";

        $this->pdo = new PDO(
            'mysql:host=' . $this->host . ';dbname=' . $this->dbname,
            $this->user,
            $this->password
        );
        $this->pdo->exec('SET NAMES UTF8');
    }

    public function query(string $sql, $params = [])
    {
        try {
            $sth = $this->pdo->prepare($sql);
            $result = $sth->execute($params);

            if (false === $result) {
                return null;
            }

            return $sth->fetchAll();
        } catch (\PDOException $e) {

        }
    }
}