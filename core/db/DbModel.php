<?php

namespace app\core\db;

use app\core\Application;
use app\core\Model;
use PDO;

abstract class DbModel extends Model
{
    // Table want to be saved
    abstract public function tableName(): string;

    // List attribute save to Db
    abstract public function attributes() : array;

    abstract public function primaryKey() : string;

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
        $attributesWhere = array_keys($where);
        $params = array_map(fn($attr) => "$attr = :$attr", $attributes);
        $sql = implode('AND ', array_map(fn($attr) => "$attr = '%$attr'", $attributesWhere));
        $sqlFinal = "UPDATE $tableName SET ".implode(', ', $params)." WHERE $sql";
        foreach ($attributes as $attribute) {
            if ($this->{$attribute} === '') {
                $sqlFinal = str_replace(":$attribute", "''", $sqlFinal);
            } else {
                $sqlFinal = str_replace(":$attribute", '\''.$this->{$attribute}.'\'', $sqlFinal);
            }
        }
        foreach ($where as $key => $item) {
            $sqlFinal = str_replace("%$key", "$item", $sqlFinal);
        }
        $statement = self::prepare($sqlFinal);
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

    public function findAll(array $where, string $method = '=')
    {
        $tableName = static::tableName();
        $attributes = array_keys($where);
        $sql = implode('AND ', array_map(fn($attr) => "$attr $method :$attr", $attributes));
        $statement = self::prepare("SELECT * FROM $tableName WHERE $sql");
        foreach ($where as $key => $item) {
            $statement->bindValue(":$key", $item);
        }
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS , static::class);
    }
}