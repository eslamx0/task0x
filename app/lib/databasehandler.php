<?php
namespace Task\Lib;

class DatabaseHandler
{

    // Database handler attributes
    private $host = DB_HOST;
    private $name = USER;
    private $pwd = PWD;
    private $dbname = DB_NAME;

    public function connect()
    {
        $dns = "mysql:host=" . $this->host . ";dbname=" . $this->dbname;

        //Checking the connection and raising an error if the connection failed
        try {
            $pdo = new \PDO($dns, $this->name, $this->pwd);
            $pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
            return $pdo;
        } catch (\PDOException $e) {
            $error = $e->getMessage();
            echo $error;
            die();
        }
    }
}
