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
    private static PDO $conn;
    private static string $table;
    private static string $query;
    private static bool $select = false;
    private static string $columns;
    private static bool $where = false;
    private static array $conditions = [];

    /**
     * DB constructor.
     */
    public function __construct()
    {
        try {
            if(empty(self::$conn)) {
                self::$conn = new PDO("mysql:host=$this->serverName;dbname=$this->dbName", $this->username, $this->password);
                // set the PDO error mode to exception
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//            echo "Connected successfully";
            }
        }catch(PDOException $e) {
            return die("Connection failed: " . $e->getMessage());
        }
    }

    /**
     * @param string $name
     * @return DB
     */
    public static function table(string $name): DB
    {
        self::$table = $name;
        return new self();
    }

    /**
     * @param string ...$params
     * @return DB
     */
    public static function select(string ...$params): DB
    {
        $columns = '';
        foreach ($params as $param) :
            $columns .= "$param" . ",";
        endforeach;
        $columns = substr($columns, 0, -1);

        self::$select = true;
        self::$columns = $columns;
        self::$query = sprintf('SELECT '. $columns .' FROM %s', self::$table);
        return new self();
    }

    /**
     * @param array $conditions
     * @return DB
     */
    public static function where(string|int|array ...$params): DB
    {
        self::$where = true;
        self::$conditions = $params;

        //Check Select if exists
        if(self::$select) :
            self::select(self::$columns);
        else :
            self::$query = sprintf('SELECT * FROM %s', self::$table);
        endif;

        //ADD WHERE STATEMENT
        self::$query .= " WHERE ";
        if(count($params) == 1) : // ->where(['title' => 'OOP', 'status' => 1])
            foreach ($params[0] as $key => $value) :
                $value = !is_int($value) ? "'$value'" : $value;
                self::$query .= $key . "=" . $value . " AND ";
            endforeach;
            self::$query = substr(trim(self::$query), 0, -3);
        elseif(count($params) == 2) : // ->where('status', 1)
            $params[1] = !is_int($params[1]) ? "'$params[1]'" : $params[1];
            self::$query .= $params[0] . "=" . $params[1];
        elseif(count($params) == 3) : // ->where('status, '=!', 1)
            $params[2] = !is_int($params[2]) ? "'$params[2]'" : $params[2];
            self::$query .= $params[0] . $params[1] . $params[2];
        endif;

        return new self();
    }

    /**
     * @return string
     */
    public static function prepareSql(): string
    {
        return trim(htmlspecialchars(self::$query));
    }

    /**
     * @return array
     */
    public static function get(): array
    {
        return self::$conn->query(self::prepareSql())->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function all(): array
    {
        return self::$conn->query("SELECT * FROM " . self::$table)->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @return array|bool
     */
    public function first(): array|bool
    {
        return self::$conn->query(self::prepareSql())->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * @param array $request
     * @return bool
     */
    public static function create(array $request): bool
    {
        // Get columns name as string
        $columns = implode(",", array_keys($request));
        // Prepare values
        $values = '';
        $execute_data = [];
        foreach ($request as $key => $value) :
            $prepared_key = ":$key";
            $values .= $prepared_key . ",";
            $execute_data[$prepared_key] = $value;
        endforeach;
        $values = substr(strtolower($values), 0,-1);
        // Run Query
        $sql = "INSERT INTO " . self::$table . " ($columns) VALUES ($values)";
        $stmt = self::$conn->prepare($sql);
        return $stmt->execute($execute_data);
    }

    /**
     * @param int $id
     * @return bool
     */
    public static function delete(int $id): bool
    {
        $sql = "DELETE FROM " . self::$table . " WHERE id=?";
        $stmt= self::$conn->prepare($sql);
        return $stmt->execute([$id]);
    }
}