<?php

namespace Core\Database;

use PDO;
use Core\Database\Connection;
// use Core\Kernel;
abstract class QueryBuilder
{
    protected $pdo;
    protected $tableName;

    protected $columns = [];
    protected $where;
    protected $join;
    protected $orderBy;
    protected $limit;


    /**
     * Create a new QueryBuilder instance.
     *
     * @param PDO $pdo
     *
     * @throws \ReflectionException
     */
    public function __construct()
    {
        $this->pdo = Connection::connect();
        $this->tableName = $this->tableName ?? strtolower((new \ReflectionClass($this))->getShortName()).'s';
    }

    public function where($where)
    {
        $this->where = $where;
        return $this;
    }

    public function join($join)
    {
        $this->join = $join;
        return $this;
    }
    public function columns($columns=[])
    {
        $this->columns = $columns;
        return $this;
    }


    /**
     * Adding set of conditions as a string.
     *
     * @param array $conditions
     *
     * @return $this
     */
    // public function where($conditions)
    // {
    //     $this->where = ' where '.implode(', ', $conditions);

    //     return $this;
    // }

    /**
     * Adding order query string.
     *
     * @param string $column
     * @param string $order
     *
     * @return $this
     */
    public function orderBy($column, $order = 'ASC')
    {
        $this->orderBy = " order by $column $order";

        return $this;
    }

    /**
     * Adding the limitation clause.
     *
     * @param int $start
     * @param int $end
     *
     * @return $this
     */
    public function limit($start, $end)
    {
        $this->limit = " limit {$start},{$end}";

        return $this;
    }

    /**
     * Select all records from a database table.
     *
     * @param array $columns
     *
     * @return array
     */
    public function selectAll($columns = [])
    {
        $sql = "SELECT * from {$this->tableName}";
        $statement = $this->executeStatement($sql);

        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function get($id)
    {
        $sql = "SELECT * from {$this->tableName} WHERE id = {$id}";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_OBJ);
    }

    public function query()
    {
        $query = "SELECT ";
        if(count($this->columns)>0) {
            $query .= implode(", ", $this->columns);
        } else {
            $query .= "*";
        }

        $query .= " FROM ";
        $query .= $this->tableName;

        if (!empty($this->join)) {
            foreach ($this->join as $k => $v) {
                $query .= " INNER JOIN ".$k;
                $query .= " ON ".$k;
                $query .= ".id=".$this->tableName;
                $query .= ".".$v;
            }    
        }

        if (!empty($this->where)) {
            $query .= " WHERE ";
            $query .= $this->where;
        }
        return $query;    
    }


    public function getAll() 
    {
        $statement = $this->pdo->prepare($this->query());
        $statement->execute();
        return $statement->fetchAll();
    }

    public function findBy($condition)
    {
        // $stmt = $this->connect->prepare($this->select()->where($condition)->query());
        // $stmt->execute();
        $sql = "SELECT * from {$this->tableName} WHERE $condition";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetch();
    }


    /**
     * Select all records from a database table.
     *
     * @param array $columns
     *
     * @return array
     */
    public function select($columns = [])
    {
        $fields = $columns ? implode(', ', $columns) : '*';
        $sql = $this->attachClauses("select $fields from {$this->tableName}");
        $statement = $this->executeStatement($sql);

        return $statement->fetchAll(PDO::FETCH_CLASS);
    }


    /**
     * Select single record from a database table.
     *
     * @param array $columns
     *
     * @return array
     */
    public function selectOne($columns = [])
    {
        $this->limit(0, 1);
        $fields = $columns ? implode(', ', $columns) : '*';
        $sql = $this->attachClauses("select {$fields} from {$this->tableName}");
        $statement = $this->executeStatement($sql);

        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    /**
     * Insert a record into a table.
     *
     * @param array $parameters
     *
     * @return bool|\PDOStatement
     */
    public function insert($parameters)
    {
        $sql = sprintf(
            'insert into %s (%s) values (%s)',
            $this->tableName,
            implode(', ', array_keys($parameters)),
            ':'.implode(', :', array_keys($parameters))
        );

        try {
            return $this->executeStatement($sql, $parameters);
        } catch (\Exception $exception) {
            die($exception->getMessage());
        }
    }

    /**
     * Update specific record(s).
     *
     * @param array $parameters
     *
     * @return bool|\PDOStatement
     */
    public function update($parameters)
    {
        $id = $parameters['id'];
        if (isset($parameters['id'])) unset($parameters['id']);

        $values = array_map(function ($key, $value) {
            return "{$key} = '{$value}'";
        }, array_keys($parameters), $parameters);
        $sql = 
        sprintf("UPDATE %s set %s WHERE id = %s", $this->tableName, implode(', ', $values), $id);

        $statement = $this->pdo->prepare($sql);
        return $statement->execute();
    }

    /**
     * Delete record(s) from table.
     *
     * @return bool|\PDOStatement
     */
    public function delete($id)
    {
        $sql = sprintf("DELETE FROM %s WHERE id = %s", $this->tableName, $id);

        try {
            return $this->executeStatement($sql);
        } catch (\Exception $exception) {
            die($exception->getMessage());
        }
    }

    /**
     * Prepare and execute statement.
     *
     * @param string $sql
     * @param array  $parameters
     *
     * @return bool|\PDOStatement
     */
    protected function executeStatement($sql, $parameters = [])
    {
        $statement = $this->pdo->prepare(query: $sql);
        $statement->execute(params: $parameters);

        return $statement;
    }

    /**
     * Attach the extra clauses to the query.
     *
     * @param string $sql
     *
     * @return string
     */
    protected function attachClauses($sql)
    {
        if ($this->where) {
            $sql .= $this->where;
        }
        if ($this->orderBy) {
            $sql .= $this->orderBy;
        }
        if ($this->limit) {
            $sql .= $this->limit;
        }

        return $sql;
    }
}
