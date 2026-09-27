<?php

require_once __DIR__ . "/../../../core/DataBase.php";
require_once __DIR__ . "/../Model.php";

class doneOrder extends Model
{

    public static function doneOrder()
    {
        $DB = Database::getConnection();
        $orderId = (int) Request::DataSpecific('orderId');

        $DB->beginTransaction();

        try {
            $stmt = $DB->prepare(
                "SELECT orders_items.book_id, orders_items.quantity, books.stock
                FROM orders_items
                INNER JOIN orders
                    ON orders.id = orders_items.order_id
                INNER JOIN books
                    ON books.id = orders_items.book_id
                WHERE orders_items.order_id = :orderId
                    AND orders.status = 'ordered'
                FOR UPDATE"
            );

            $stmt->execute(['orderId' => $orderId]);
            $items = $stmt->fetchAll();

            if (empty($items)) {
                $DB->rollBack();
                Response::json_response([], 'The order is empty or already processed.', 422);
            }

            foreach ($items as $item) {
                if ((int) $item['quantity'] > (int) $item['stock']) {
                    $DB->rollBack();
                    Response::json_response([
                        'quantityBooks' => [
                            "Only {$item['stock']} item(s) available in stock."
                        ]
                    ], 'Not enough stock.', 422);
                }
            }

            $updateStock = $DB->prepare(
                "UPDATE books
                SET stock = stock - :quantity
                WHERE id = :bookId AND stock >= :quantity"
            );

            $stockUpdates = [];
            foreach ($items as $item) {
                $quantity = (int) $item['quantity'];
                $updateStock->execute([
                    'quantity' => $quantity,
                    'bookId' => (int) $item['book_id']
                ]);

                $stockUpdates[] = [
                    'bookId' => (int) $item['book_id'],
                    'stock' => (int) $item['stock'] - $quantity
                ];
            }

            $stmt = $DB->prepare(
                "UPDATE orders
                SET status = 'done'
                WHERE id = :orderId AND status = 'ordered'"
            );
            $stmt->execute(['orderId' => $orderId]);

            $DB->commit();

            Response::json_response([
                'orderId' => $orderId,
                'status' => 'done',
                'stockUpdates' => $stockUpdates
            ]);
        } catch (Throwable $exception) {
            if ($DB->inTransaction()) {
                $DB->rollBack();
            }

            Response::json_response([], 'Unable to approve the order.', 500);
        }
    }
}
