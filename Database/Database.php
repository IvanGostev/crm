<?php

namespace Database;

class Database
{
    private static ?self $instance = null;
    private \PDO $connect;

    private function __construct()
    {
        $host = DB_HOST;
        $name = DB_NAME;
        $user = DB_USER;
        $password = DB_PASS;
        try {
            $dsn = "mysql:host=$host;dbname=$name";
            $this->connect = new \PDO($dsn, $user, $password);
            $this->connect->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $exception) {
            echo "Connect failed: " . $exception->getMessage();
        }
    }


    // Возвращает сам объект instance


    public static function getInstance(): ?self
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    // Возвращает объект подключения к БД
    public function getConnection(): \PDO
    {
        return $this->connect;
    }

}