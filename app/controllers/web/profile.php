<?php
require_once __DIR__ . "/../controller.php";
require_once __DIR__ . "/../../models/DB/DBModel.php";
require_once __DIR__ . "/../../models/orders/orderModel.php";
require_once __DIR__ . "/../../models/Books/BookModel.php";

class profileController extends Controller{

    public function index()
    {
        $data = null;

        if (isAuth('admin')) {
            $data = $this->getAdminData();
        } else {
            $data = $this->getCustomerData();
        }

        $this->view("profile/profile", $data);
    }

    public function getAdminData():Array{

        $totalBooks = DBModel::getTotalOfTable('books');
        $totalAuthors = DBModel::getTotalOfTable('authors');
        $totalCustomers = DBModel::getTotalOfTable('users',[['role','=','customer']]);
        $totalAdmins = DBModel::getTotalOfTable('users', [['role', '=', 'admin']]);
        $totalOrdersOrderd = DBModel::getTotalOfTable('orders', [['status', '=', 'ordered']]);
        $totalOrdersCanceld = DBModel::getTotalOfTable('orders', [['status', '=', 'canceled']]);
        $totalOrdersDone = DBModel::getTotalOfTable('orders', [['status', '=', 'done']]);

        $admin = DBModel::getDataOfTable('users',[['role','=','admin'],['id','!=',auth('id')]],Request::DataSpecific('home-page',1));
        $customer = DBModel::getDataOfTable('users', [['role', '=', 'customer']], Request::DataSpecific('Customers-page', 1));
        $author = DBModel::getDataOfTable('authors', page : Request::DataSpecific('Authors-page', 1));
        $books = BookModel::getDataOfBooks(page : Request::DataSpecific('Books-page', 1));
        $orders = [
            'ordered' =>  OrderModel::getDataOfOrders([['status', '=', 'ordered']], Request::DataSpecific('Ordered-page', 1)),
            'canceled' => OrderModel::getDataOfOrders([['status', '=', 'canceled']], Request::DataSpecific('Canceled-page', 1)),
            'done' => OrderModel::getDataOfOrders([['status', '=', 'done']], Request::DataSpecific('Done-page', 1))
        ];

        return [
            'totalBooks' => $totalBooks,
            'totalAuthors' => $totalAuthors,
            'totalCustomers' => $totalCustomers,
            'totalAdmins' => $totalAdmins,
            'totalOrdersOrderd' => $totalOrdersOrderd,
            'totalOrdersCanceld' => $totalOrdersCanceld,
            'totalOrdersDone' => $totalOrdersDone,
            'Admin' => $admin,
            'customer' => $customer,
            'author' => $author,
            'books' => $books,
            'orders' => $orders,
        ];
    }

    public function getCustomerData(): array
    {

        $totalBooks = DBModel::getTotalOfTable('books');
        $totalBoughtBooks = DBModel::getTotalBoughtOfCustomer();
        $totalOrdersOrderd = DBModel::getTotalOfTable('orders', [['status', '=', 'ordered'], ['customer_id', '=', auth('id')]]);
        $totalOrdersCanceld = DBModel::getTotalOfTable('orders', [['status', '=', 'canceled'], ['customer_id', '=', auth('id')]]);
        $totalOrdersDone = DBModel::getTotalOfTable('orders', [['status', '=', 'done'], ['customer_id', '=', auth('id')]]);
        $author = DBModel::getDataOfTable('authors', page: Request::DataSpecific('Authors-page', 1));
        $books = BookModel::getDataOfBooks(page: Request::DataSpecific('Books-page', 1));
        $totalItemsIntoCart = CartModel::totalItemsIntoOrders();
        $orders = [
            'ordered' =>  OrderModel::getDataOfOrders([['status', '=', 'ordered'],['customer_id','=',auth('id')]], Request::DataSpecific('Ordered-page', 1)),
            'canceled' => OrderModel::getDataOfOrders([['status', '=', 'canceled'],['customer_id','=',auth('id')]], Request::DataSpecific('Canceled-page', 1)),
            'done' => OrderModel::getDataOfOrders([['status', '=', 'done'],['customer_id','=',auth('id')]], Request::DataSpecific('Done-page', 1))
        ];

        return [
            'totalBooks' => $totalBooks,
            'totalBoughtBooks' => $totalBoughtBooks,
            'totalOrdersOrderd' => $totalOrdersOrderd,
            'totalOrdersCanceld' => $totalOrdersCanceld,
            'totalOrdersDone' => $totalOrdersDone,
            'totalItemsIntoCart'=> $totalItemsIntoCart,
            'author' => $author,
            'books' => $books,
            'orders' => $orders,
        ];
    }

    
}