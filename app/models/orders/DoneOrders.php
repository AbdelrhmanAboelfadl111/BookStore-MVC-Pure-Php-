<?php

require_once __DIR__ . "/../../../core/DataBase.php";
require_once __DIR__ . "/../Model.php";

class doneOrder extends Model
{

    public static function doneOrder()
    {
        $orderId = Request::DataSpecific('orderId');

        $DB = Database::getConnection();

        $DB->exec("UPDATE orders SET status = 'done' WHERE id = $orderId");

        Response::json_response([
            "orderId" => $orderId,
            "status" => "done"
        ]);


    }
    
}
