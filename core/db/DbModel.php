<?php

namespace app\core\db;

use app\core\Application;
use app\core\Model;
use app\models\Subject;
use PDO;

abstract class DbModel extends Model
{
    // Table want to be saved
    abstract public function tableName(): string;
    // List attribute save to Db
    abstract public function attributes() : array;

    abstract public function primaryKey() : string;

    public function getClassSearch()
    {
        return static::class;
    }

    // INSERT
    public function save()
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $params = array_map(fn($attr) => ":$attr", $attributes);
        $statement = self::prepare("INSERT INTO $tableName (".implode(',', $attributes).")
                VALUES(".implode(',', $params).")");
        foreach ($attributes as $attribute) {
            $statement->bindValue(":$attribute", $this->{$attribute});
        }
        $statement->execute();
        return true;
    }

    public function update(array $attributes, array $where)
    {
        $tableName = $this->tableName();
        $updateColumns = array_map(fn($attr) => "$attr = :$attr", ($attributes));
        $whereColumns = array_map(fn($key) => "$key = :where_$key", array_keys($where));
        $sql = "UPDATE $tableName SET " . implode(', ', $updateColumns) . " WHERE " . implode(' AND ', $whereColumns);
        $statement = self::prepare($sql);
        // Bind values for update columns
        foreach ($attributes as $attribute => $value) {
            $statement->bindValue(":$value", $this->{$value});
        }
        // Bind values for WHERE clause
        foreach ($where as $key => $value) {
            $statement->bindValue(":where_$key", $value);
        }
        $statement->execute();
        return true;
    }


    public static function prepare($sql)
    {
        return Application::$app->db->pdo->prepare($sql);
    }

    public function findOne(array $where) // [login_id = 'hoangchiquang@example, password = 'quang']
    {
        $tableName = static::tableName();
        $attributes = array_keys($where);
        $sql = implode('AND ', array_map(fn($attr) => "$attr = :$attr", $attributes));
        $statement = self::prepare("SELECT * FROM $tableName WHERE $sql");
        foreach ($where as $key => $item) {
            $statement->bindValue(":$key", $item);
        }
        $statement->execute();
        return $statement->fetchObject(static::class);
    }

    public function findAll(array $where = [], string $method = '=', array $columns = ['*'])
    {
        $tableName = static::tableName();
        $attributes = array_keys($where);
        $columnSQL = implode(', ', $columns);
        $sql = implode('AND ', array_map(fn($attr) => "$attr $method :$attr", $attributes));
        $statement = self::prepare("SELECT $columnSQL FROM $tableName WHERE $sql");
        foreach ($where as $key => $item) {
            $statement->bindValue(":$key", $item);
        }
        if ($where === []) {
            $statement = self::prepare("SELECT $columnSQL FROM $tableName");
        }
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS , static::class);
    }

    public function search($searchKey, $searchValue)
    {
        $tableName = static::tableName();
        $sql = "SELECT * FROM $tableName WHERE ";
        $params = [];
        foreach ($searchKey as $attribute => $column) {
            if ($searchValue[$attribute] !== '' && !is_array($searchValue[$attribute])) {
                if (is_array($column)) {
                    $likeConditions = [];
                    foreach ($column as $col) {
                        $likeConditions[] = "$col LIKE :$attribute";
                    }
                    $sql .= '(' . implode(' OR ', $likeConditions) . ') AND ';
                    $params[":$attribute"] = "%$searchValue[$attribute]%";

                } else {
                    $sql .= "$column = :$attribute AND ";
                    $params[":$attribute"] = $searchValue[$attribute];
                }
            } elseif ($searchValue[$attribute] !== '') {
                if (is_array($column)) {
                    $likeConditions = [];
                    foreach ($column as $col) {
                        $val = ($searchValue[$attribute][$col]);
                        if ($val != '') {
                            $likeConditions[] = "$col LIKE :$col";
                            $params[":$col"] = "%$val%";
                        }
                    }
                    $sql .= '(' . implode(' AND ', $likeConditions) . ') AND ';

                } else {
                    $sql .= "$column = :$attribute AND ";
                    $params[":$attribute"] = $searchValue[$attribute];
                }
            }
        }
        // Remove the trailing 'AND ' from the query
        $sql = rtrim($sql, ' AND ');
        if (!$params) {
            $sql = "SELECT * FROM $tableName";
        }
        $sql .= " ORDER BY id DESC";
        $statement = self::prepare($sql);
        $statement->execute($params);
        return $statement->fetchAll(PDO::FETCH_CLASS, static::getClassSearch());
    }

    public function delete($where)
    {
        $tableName = static::tableName();
        $attributes = array_keys($where);
        $sql = implode('AND ', array_map(fn($attr) => "$attr = :$attr", $attributes));
        $statement = self::prepare("DELETE FROM $tableName WHERE $sql");
        foreach ($where as $key => $item) {
            $statement->bindValue(":$key", $item);
        }
        $statement->execute();
    }
}