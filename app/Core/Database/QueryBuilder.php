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

        try {
        $this->executerStatement($sql, $parameters);
        }catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function update($parameters) {
        $id = $parameters['id'];
        if (isset($parameters['id'])) unset($parameters['id']);
        $values = array_map(function ($key, $value) {
        return "{$key} = '{$value}'";
        }, array_keys($parameters), $parameters);
        $sql = sprintf("UPDATE %s set %s WHERE id = %s", $this->tableName, implode(', ', $values), $id);
        $statement = $this->connection->prepare($sql);
        return $statement->execute();
    }

    public function delete($id)
    {   
        $sql = "DELETE from {$this->tableName} WHERE id = {$id}";
        $statement = $this->connection->prepare($sql);
        $statement->execute();
    }
    public function get($id): mixed
    {   
        $sql = "SELECT * from {$this->tableName} WHERE id = {$id}";
        $statement = $this->connection->prepare($sql);
        $statement->execute();
        return $statement->fetch(\PDO::FETCH_OBJ);
    }

}
