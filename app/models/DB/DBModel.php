<?php
require_once __DIR__ . "/../Model.php";
require_once __DIR__ . "/../../../core/DataBase.php";
require_once __DIR__ . "/../../../core/Request.php";

class DBModel extends Model
{

    public static function getTotalOfTable(string $tableName, array $wheres = [])
    {
        $DB = Database::getConnection();
        $whereQuery = Model::prepareWhereQuery($wheres);

        $stmt = $DB->query("SELECT COUNT(*) total FROM {$tableName} $whereQuery ;");
        $result = $stmt->fetch();
        return $result['total'];
    }

    public static function getDataOfTable(string $tableName, array $wheres = [], int $page = 1): array
    {
        $DB = Database::getConnection();
        $whereQuery = Model::prepareWhereQuery($wheres);
        $offset = ($page * 10) - 10;
        $stmt = $DB->query("SELECT * FROM {$tableName} {$whereQuery} ORDER BY id DESC LIMIT 10 OFFSET {$offset} ;");
        $data = $stmt->fetchAll();
        $stmt = $DB->query("SELECT COUNT(*) AS total FROM {$tableName} {$whereQuery};");
        $total = $stmt->fetch()['total'];
        return [
            'data' => $data,
            'total' => $total,
            'current_page' => $page
        ];
    }

    public static function getTotalBoughtOfCustomer(): int
    {
        $DB = Database::getConnection();
        $customerId= auth('id');
        $stmt = $DB->query("SELECT SUM(orders_items.quantity) AS total FROM orders_items LEFT JOIN orders On orders.id = orders_items.order_id WHERE orders.customer_id = {$customerId} AND orders.status = 'done';");
        $result = $stmt->fetch();
        return (int) ($result['total'] ?? 0);
    }
    
}
