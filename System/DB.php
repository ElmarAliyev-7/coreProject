<?php

namespace System;

use PDO;
use PDOException;

class DB
{
    private string $serverName = "localhost";
    private string $dbName = "core_project";
    private string $username = "root";
    private string $password = "";
    private static $conn;
    private static string $table;
    private static string $query;

    public function __construct()
    {
        try {
            self::$conn = new PDO("mysql:host=$this->serverName;dbname=$this->dbName",
                $this->username, $this->password);
            // set the PDO error mode to exception
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public static function table($name): DB
    {
        self::$table = $name;
        return new self();
    }

    public static function all()
    {
        self::$query = sprintf('SELECT * FROM %s', self::$table);
        $stmt = self::$conn->prepare(self::$query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}