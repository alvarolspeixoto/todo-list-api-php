<?php

namespace Alvaro\TodoPhp\config\database;

class Connection
{

    private static $conn = null;
    private static $dbHost;
    private static $dbName;
    private static $dbUsername;
    private static $dbPassword;

    public static function connect()
    {

        self::$dbHost = $_ENV['DB_HOST'];
        self::$dbName = $_ENV['DB_DATABASE'];
        self::$dbUsername = $_ENV['DB_USERNAME'];
        self::$dbPassword = $_ENV['DB_PASSWORD'];

        try {

            self::$conn = new \PDO(
                'mysql:host='. self::$dbHost .';dbname=' . self::$dbName,
                self::$dbUsername,
                self::$dbPassword,
                [
                    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ,
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                ]
            );
        } catch (\PDOException $e) {
            throw new \Exception("Erro de conexão com o banco: " . $e->getMessage());
        }

        return self::$conn;
    }
}
