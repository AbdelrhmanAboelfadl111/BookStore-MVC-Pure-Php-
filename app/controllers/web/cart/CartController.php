<?php
require_once __DIR__ . "../../../controller.php";
require_once __DIR__ . "/../../../models/DB/DBModel.php";
require_once __DIR__ . "../../../../models/cart/cartModel.php";
require_once __DIR__ . "/../../../../core/Request.php";


class CartController extends Controller
{
    public function addToCart(){
        $errors = Request::validate([
            'bookId' => ['required',['exists','books','id']],
            'quantityBooks' => ['required']
        ]);
        if(!empty($errors)){
            Response::json_response($errors,"",422);
        }
        $added = CartModel::addToCart();

        $totalItems =CartModel::totalItemsIntoOrders();

        Response::json_response([
            'totalItems' => $totalItems,
            'alreadyInCart' => !$added
        ]);
    }

    public function getItemsIntoCart()
    {
        $orderId = Request::DataSpecific('orderId');

        if (empty($orderId)) {
            $orderId = null;
        }

        $data = CartModel::getItemsIntoCart($orderId);

        Response::json_response($data);
    }

    public function increaseOrderItem(){

        $errors = Request::validate([
            'orderItemId' => ['required',['exists','orders_items','id']]
        ]);

        if(!empty($errors)){
            Response::json_response($errors);
        };

        $data = CartModel::increaseOrderItem();

        Response::json_response($data);
    }

    public function decreaseOrderItem()
    {

        $errors = Request::validate([
            'orderItemId' => ['required', ['exists', 'orders_items', 'id']]
        ]);

        if (!empty($errors)) {
            Response::json_response($errors);
        };

        $data = CartModel::decreaseOrderItem();

        Response::json_response($data);
    }

    public function deleteOrderItem()
    {

        $errors = Request::validate([
            'orderItemId' => ['required', ['exists', 'orders_items', 'id']]
        ]);

        if (!empty($errors)) {
            Response::json_response($errors);
        };

        $data = CartModel::deleteOrderItem();

        Response::json_response($data);
    }


    public function fireOrder()
    {
        $errors = Request::validate([
            'orderId' => ['required', ['exists', 'orders', 'id']]
        ]);

        if (!empty($errors)) {
            Response::json_response($errors, "", 422);
        }

        CartModel::fireOrder();

        Response::json_response([
            'message' => 'Order placed successfully'
        ]);
    }

    public function getOrderedOrders()
    {
        $orders = CartModel::getOrderedOrders();

        require_once __DIR__ . "/../../../views/profile/components/orderedBooks.php";
    }

    public function getDoneOrdersList()
    {
        $orders = CartModel::getDoneOrdersList();

        require_once __DIR__ . "/../../../views/profile/components/done.php";
    }
}
