<?php
require_once __DIR__ . "/../../controller.php";
require_once __DIR__ . "/../../../models/orders/DoneOrders.php";
require_once __DIR__ . "/../../../models/DB/DBModel.php";
require_once __DIR__ . "/../../../../core/Request.php";


class doneOrderController extends Controller
{
    public function DoneOrder()
    {
        $orderId = Request::DataSpecific('orderId');

        if (empty($orderId)) {
            Response::json_response(['error' => 'Order ID is required'], "", 422);
        }

        doneOrder::doneOrder();
    }
}
