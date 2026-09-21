<?php

require_once __DIR__ . "/../../../core/DataBase.php";
require_once __DIR__ . "/../Model.php";

class OrderModel extends Model
{
    public static function getDataOfOrders(array $wheres = [], int $page = 1): array
    {
        $DB = Database::getConnection();

        $whereQuery = Model::prepareWhereQuery($wheres);

        $offset = ($page * 10) - 10;

        $stmt = $DB->query("
            SELECT orders.*, users.name AS users_name
            FROM orders
            LEFT JOIN users ON users.id = orders.customer_id
            {$whereQuery}
            ORDER BY orders.created_at DESC, orders.id DESC
            LIMIT 10 OFFSET {$offset}
        ");

        $data = $stmt->fetchAll();

        $stmt = $DB->query("
            SELECT COUNT(*) AS total
            FROM orders
            LEFT JOIN users ON users.id = orders.customer_id
            {$whereQuery}
        ");

        $total = $stmt->fetch()['total'];

        return [
            'data' => $data,
            'total' => $total,
            'current_page' => $page
        ];
    }
}
