<?php

namespace JSRO\Database;


class Connection
{

    private $pdo;

    public function __construct()
    {

        try {

            $config = parse_ini_file("config.ini", true);

            $this->pdo = new \PDO("mysql:host={$config["database"]["host"]};dbname={$config["database"]["dbname"]}", $config["database"]["user"], $config["database"]["password"]);
            return $this;

        } catch (\PDOException $e){

            return $e->getMessage() . "\n" . $e->getTraceAsString();

        }

    }

    public function getPdo()
    {
        return $this->pdo;
    }

} 