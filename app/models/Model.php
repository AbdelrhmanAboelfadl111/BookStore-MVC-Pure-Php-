<?php
require_once __DIR__ . "/../../core/DataBase.php";
class Model
{
    protected PDO $DB;
    public function __construct()
    {
        $this->DB = Database::getConnection();
    }

    public static function prepareWhereQuery(array $where = []): string
    {
        if (empty($where)) {
            return "";
        }

        $conditions = [];
        foreach ($where as $condition) {
            if (!isset($condition[0], $condition[1], $condition[2])) {
                continue;
            }

            $field = $condition[0];
            $operator = $condition[1];
            $value = $condition[2];
            $conditions[] = "{$field} {$operator} '{$value}'";
        }

        if (empty($conditions)) {
            return "";
        }

        return "WHERE " . implode(" AND ", $conditions);
    }
}
