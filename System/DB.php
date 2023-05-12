<?php

namespace System;

use mysqli;
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
    private static bool $select = false;
    private static string $columns;
    private static bool $where = false;
    private static array $conditions;

    public function __construct()
    {
        self::$conn = new mysqli($this->serverName, $this->username, $this->password, $this->dbName);
        if (self::$conn->connect_error)
            die("Connection failed: " .  self::$conn->connect_error);
    }

    public static function table(string $name): DB
    {
        self::$table = $name;
        return new self();
    }

    public static function select(string $columns): DB
    {
        self::$select = true;
        self::$columns = $columns;
        self::$query = sprintf('SELECT '. $columns .' FROM %s', self::$table);
        return new self();
    }

    public static function where(array $conditions): DB
    {
        self::$where = true;
        self::$conditions = $conditions;

        if(self::$select) :
            self::select(self::$columns);
        else :
            self::$query = sprintf('SELECT * FROM %s', self::$table);
        endif;

        if($conditions > 1) :
            self::$query .= " WHERE";
        endif;

        foreach ($conditions as $column => $value) :
            $value = is_string($value) ? "'$value'" : $value;
            self::$query .= "  $column = $value AND";
        endforeach;
        self::$query = substr(self::$query, 0, -3);
        return new self();
    }

    public static function prepare(): string
    {
        if(self::$select === true && self::$where === false) :
            self::select(self::$columns);
        elseif(self::$where) :
            self::where(self::$conditions);
        else:
            self::$query = sprintf('SELECT * FROM %s', self::$table);
        endif;
        return trim(htmlspecialchars(self::$query));
    }

    public static function all(): object
    {
        $result = mysqli_query(self::$conn, self::prepare());
        $row = mysqli_fetch_assoc($result);
        return (object) $row;
    }
}