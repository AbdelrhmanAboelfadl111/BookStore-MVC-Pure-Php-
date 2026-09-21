<?php
require_once __DIR__ . "/../../controller.php";
require_once __DIR__ . "/../../../models/orders/canelModel.php";
require_once __DIR__ . "/../../../models/DB/DBModel.php";
require_once __DIR__ . "/../../../../core/Request.php";


class CancelOrderController extends Controller
{
    public function CancelOrder()
    {
        $orderId = Request::DataSpecific('orderId');
        $reason = Request::DataSpecific('reason');

        if($reason === null || $reason === ""){
            Response::json_response(['error' => 'Reason is required']);
        }else if (empty($orderId)) {
            Response::json_response(['error' => 'Order ID is required'], "", 422);
        }else{
            cancelOrder::cancelOrder();
            response::json_response([
                "orderId" => $orderId,
                "reason" => $reason,
                "status" => "canceled"
            ]);
        }

        
    }
}
