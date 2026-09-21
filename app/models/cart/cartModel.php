<?php

require_once __DIR__ . "/../../../core/DataBase.php";
require_once __DIR__ . "/../Model.php";

class CartModel extends Model
{

    private static function getPendingOrderId(): false|int
    {
        $DB = Database::getConnection();
        $authId = auth('id');

        $stmt = $DB->query(
            "SELECT id
            FROM orders
            WHERE customer_id = {$authId}
            AND status = 'pending'
            LIMIT 1"
        );

        $orderId = $stmt->fetchColumn();

        return $orderId === false ? false : (int) $orderId;
    }


    private static function getOrderItemId(string $orderId, string $bookId): false|int
    {
        $DB = Database::getConnection();

        $stmt = $DB->query(
            "SELECT id
            FROM orders_items
            WHERE order_id = {$orderId}
            AND book_id = {$bookId}
            LIMIT 1"
        );

        $itemId = $stmt->fetchColumn();

        return $itemId === false ? false : (int) $itemId;
    }


    private static function updateToTalPriceOfOrders(string $orderId)
    {
        $DB = Database::getConnection();

        $totalPrice = $DB->query(
            "SELECT SUM(subtotal)
            FROM orders_items
            WHERE order_id = {$orderId}"
        )->fetchColumn() ?? 0;

        $DB->exec(
            "UPDATE orders
            SET total_price = {$totalPrice}
            WHERE id = {$orderId}"
        );

        return $totalPrice;
    }

    public static function totalItemsIntoOrders()
    {
        $DB = Database::getConnection();
        $orderId = self::getPendingOrderId();

        if ($orderId === false) {
            return 0;
        }

        $totalItems = $DB->query(
            "SELECT SUM(quantity)
        FROM orders_items
        WHERE order_id = {$orderId}"
        )->fetchColumn();

        return $totalItems ?? 0;
    }


    public static function addToCart()
    {
        $DB = Database::getConnection();

        $authId = auth('id');

        $pendingOrderId = self::getPendingOrderId();


        if ($pendingOrderId === false) {
            $DB->exec(
                "INSERT INTO orders (customer_id, status)
                VALUES ('{$authId}', 'pending')"
            );
            $pendingOrderId = (int) $DB->lastInsertId();
        }


        $bookId = Request::DataSpecific('bookId');
        $quantity = Request::DataSpecific('quantityBooks');

        $orderItemId = self::getOrderItemId(
            $pendingOrderId,
            $bookId
        );


        if ($orderItemId === false) {

            $unitPrice = $DB->query(
                "SELECT price
                FROM books
                WHERE id = '{$bookId}'"
            )->fetchColumn();


            $stmt = $DB->prepare(
                "INSERT INTO orders_items
                (
                    order_id,
                    book_id,
                    quantity,
                    unit_price,
                    subtotal
                )
                VALUES
                (
                    :order_id,
                    :book_id,
                    :quantity,
                    :unit_price,
                    :subtotal
                )"
            );


            $stmt->execute([
                'order_id'   => $pendingOrderId,
                'book_id'    => $bookId,
                'quantity'   => $quantity,
                'unit_price' => $unitPrice,
                'subtotal'   => $unitPrice * $quantity
            ]);
        } else {

            $unitPrice = $DB->query(
                "SELECT price
                FROM books
                WHERE id = '{$bookId}'"
            )->fetchColumn();

            $newSubTotal = $unitPrice * $quantity;


            $DB->exec(
                "UPDATE orders_items
                SET
                    quantity = quantity + {$quantity},
                    unit_price = {$unitPrice},
                    subtotal = subtotal + {$newSubTotal}
                WHERE id = {$orderItemId}"
            );
        }


        self::updateToTalPriceOfOrders($pendingOrderId);
    }


    public static function getItemsIntoCart(?int $orderId = null)
    {
        $DB = Database::getConnection();

        if ($orderId === null) {
            $orderId = self::getPendingOrderId();

            if ($orderId === false) {
                return [];
            }
        }

        $stmt = $DB->prepare("
        SELECT  
            books.id AS book_id, 
            books.title, 
            books.image, 
            books.description, 
            books.price, 
            authors.id AS author_id, 
            authors.name AS authors_name, 
            orders.id AS order_id, 
            orders_items.id AS order_item_id, 
            orders_items.quantity, 
            orders_items.subtotal, 
            orders.total_price,
            orders.cancel_reason
        FROM orders_items 
        LEFT JOIN orders 
            ON orders.id = orders_items.order_id 
        LEFT JOIN books 
            ON books.id = orders_items.book_id 
        LEFT JOIN authors 
            ON authors.id = books.author_id 
        WHERE orders.id = :order_id
    ");

        $stmt->execute([
            'order_id' => $orderId
        ]);

        return $stmt->fetchAll();
    }

    public static function increaseOrderItem()
    {
        $DB = Database::getConnection();

        $orderItemId = Request::DataSpecific("orderItemId");

        $stmt = $DB->prepare("
        UPDATE orders_items
        SET 
            quantity = quantity + 1,
            subtotal = subtotal + unit_price
        WHERE id = :orderItemId
    ");

        $stmt->execute([
            'orderItemId' => $orderItemId
        ]);


        $stmt = $DB->prepare("
        SELECT *
        FROM orders_items
        WHERE id = :orderItemId
    ");

        $stmt->execute([
            'orderItemId' => $orderItemId
        ]);

        $orderItem = $stmt->fetch();


        if (!$orderItem) {
            return false;
        }


        $orderId = self::getPendingOrderId();

        if ($orderId === false) {
            return false;
        }


        $totalPrice = self::updateToTalPriceOfOrders($orderId);


        return [
            "orderItem" => $orderItem,
            "orderId" => $orderId,
            "totalPrice" => $totalPrice
        ];
    }

    public static function decreaseOrderItem()
    {
        $DB = Database::getConnection();

        $orderItemId = Request::DataSpecific("orderItemId");


        $stmt = $DB->prepare("
        SELECT *
        FROM orders_items
        WHERE id = :orderItemId
    ");

        $stmt->execute([
            'orderItemId' => $orderItemId
        ]);

        $orderItem = $stmt->fetch();


        if (!$orderItem) {
            return false;
        }


        if ($orderItem['quantity'] > 1) {

            $stmt = $DB->prepare("
            UPDATE orders_items
            SET 
                quantity = quantity - 1,
                subtotal = subtotal - unit_price
            WHERE id = :orderItemId
            ");

            $stmt->execute([
                'orderItemId' => $orderItemId
            ]);


            $stmt = $DB->prepare("
            SELECT *
            FROM orders_items
            WHERE id = :orderItemId
        ");

            $stmt->execute([
                'orderItemId' => $orderItemId
            ]);

            $orderItem = $stmt->fetch();
        } else {

            $orderItem['quantity'] = 0;
            $orderItem['subtotal'] = 0;

            $stmt = $DB->prepare("
            DELETE
            FROM orders_items
            WHERE id = :orderItemId
            ");

            $stmt->execute([
                'orderItemId' => $orderItemId
            ]);
        }


        $orderId = self::getPendingOrderId();

        if ($orderId === false) {
            return false;
        }


        $totalPrice = self::updateToTalPriceOfOrders($orderId);


        return [
            "orderItem" => $orderItem,
            "orderId" => $orderId,
            "totalPrice" => $totalPrice
        ];
    }

    public static function deleteOrderItem(){
        $DB = Database::getConnection();
        $stmt = $DB->prepare(" DELETE
            FROM orders_items
            WHERE id = :orderItemId;");

        $stmt->execute([
            'orderItemId' =>Request::DataSpecific('orderItemId')
        ]);

        $orderId = self::getPendingOrderId();

        $totalPrice = self::updateToTalPriceOfOrders($orderId);

        return [
            'orderId' => $orderId,
            'totalPrice' => $totalPrice
        ];

    }

    public static function fireOrder()
    {
        $DB = Database::getConnection();
        $stmt = $DB->prepare(" UPDATE orders SET status = 'ordered'
            WHERE id = :orderId;");

        $stmt->execute([
            'orderId' => Request::DataSpecific('orderId')
        ]);

        
    }

    public static function getOrderedOrders()
    {
        $DB = Database::getConnection();

        $currentPage = (int) (Request::DataSpecific('Ordered-page') ?? 1);

        if ($currentPage < 1) {
            $currentPage = 1;
        }

        $limit = 10;
        $offset = ($currentPage - 1) * $limit;

        // Get total number of ordered orders
        $total = $DB->query("
        SELECT COUNT(*)
        FROM orders
        WHERE status = 'ordered'
    ")->fetchColumn();

        // Get orders
        $stmt = $DB->prepare("
        SELECT
            orders.id,
            orders.total_price,
            orders.created_at,
            users.name AS users_name
        FROM orders
        INNER JOIN users
            ON users.id = orders.customer_id
        WHERE orders.status = 'ordered'
        ORDER BY orders.id DESC
        LIMIT :limit OFFSET :offset
    ");

        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

        $stmt->execute();

        $data = $stmt->fetchAll();

        return [
            'ordered' => [
                'data' => $data,
                'total' => $total,
                'current_page' => $currentPage
            ]
        ];
    }

    public static function getDoneOrdersList()
    {
        $DB = Database::getConnection();

        $currentPage = (int) (Request::DataSpecific('Done-page') ?? 1);

        if ($currentPage < 1) {
            $currentPage = 1;
        }

        $limit = 10;
        $offset = ($currentPage - 1) * $limit;

        $total = $DB->query("
        SELECT COUNT(*)
        FROM orders
        WHERE status = 'done'
    ")->fetchColumn();

        $stmt = $DB->prepare("
        SELECT
            orders.id,
            orders.total_price,
            orders.created_at,
            users.name AS users_name
        FROM orders
        INNER JOIN users
            ON users.id = orders.customer_id
        WHERE orders.status = 'done'
        ORDER BY orders.id DESC
        LIMIT :limit OFFSET :offset
    ");

        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        $data = $stmt->fetchAll();

        return [
            'done' => [
                'data' => $data,
                'total' => $total,
                'current_page' => $currentPage
            ]
        ];
    }

}
