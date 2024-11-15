<?php

namespace Core\Database;

// use Connection;
use Core\Kernel;
use PDOException;

abstract class QueryBuilder
{

    protected $connection;
    protected $tableName;

    public function __construct()
    {
        $config = require_once Kernel::projectDir().'/config/db.php';
        $this->connection = Connection::make($config['database']);
        $this->tableName = $this->tableName ?? strtolower((new \ReflectionClass($this))->getShortName()).'s';
    }
    public function selectAll(array $columns = [])
    {
        $fields = $columns ? implode(',', $columns) :'*';
        $sql = "SELECT $fields FROM {$this->tableName}";
        $statement = $this->executerStatement($sql);
        return $statement->fetchAll(\PDO::FETCH_CLASS);
    }
    
    private function executerStatement($sql, $parameters = [])
    {
        $statement = $this->connection->prepare($sql);
        $statement->execute($parameters);
        return $statement;
    }

    public function insert(array $parameters)
    {
        $sql = sprintf(
            "INSERT INTO %s (%s) VALUES (%s)",
            $this->tableName, 
            implode(", ", array_keys($parameters)),
            ':'.implode(", :", array_keys($parameters))
        );
        // var_dump($sql);
        // var_dump($parameters);
        try {
        $this->executerStatement($sql, $parameters);
        }catch (PDOException $e) {
            die($e->getMessage());
        }
    }

}
