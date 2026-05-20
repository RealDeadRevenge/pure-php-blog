<?php

namespace App\Core;

use PDO;
use PDOException;

class Database
{
    /** @var PDO|null */
    private static ?PDO $connection = null;

    /**
     * @return PDO
     */
    public static function connect(): PDO
    {
        if (self::$connection !== null) {
            return self::$connection;
        }

        $host = $_ENV['MYSQL_HOST'] ?? 'mysql';
        $port = $_ENV['MYSQL_PORT'] ?? '3306';
        $database = $_ENV['MYSQL_DATABASE'] ?? '';
        $username = $_ENV['MYSQL_USER'] ?? '';
        $password = $_ENV['MYSQL_PASSWORD'] ?? '';

        $dsn = sprintf(
            'mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4',
            $host,
            $port,
            $database,
        );

        try {
            self::$connection = new PDO($dsn, $username, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);

            return self::$connection;
        } catch (PDOException $exception) {
            die($exception->getMessage());
        }
    }
}