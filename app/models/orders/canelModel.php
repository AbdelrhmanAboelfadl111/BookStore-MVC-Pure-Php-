<?php

require_once __DIR__ . "/../../../core/DataBase.php";
require_once __DIR__ . "/../Model.php";

class cancelOrder extends Model
{

    public static function cancelOrder()
    {
        $orderId = Request::DataSpecific('orderId');

        $orderReason = Request::DataSpecific('reason');

        $DB = Database::getConnection();

        $DB->exec("UPDATE orders SET status = 'canceled' , cancel_reason = '$orderReason'  WHERE id = $orderId");

    }
}
