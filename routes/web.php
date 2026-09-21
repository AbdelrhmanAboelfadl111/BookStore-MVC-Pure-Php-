<?php
require_once __DIR__ . "/../core/Route.php";
require_once __DIR__ . "/../app/controllers/web/HomeController.php";
require_once __DIR__ . "/../app/controllers/web/auth/loginController.php";
require_once __DIR__ . "/../app/controllers/web/auth/registerController.php";
require_once __DIR__ . "/../app/controllers/web/user/userController.php";
require_once __DIR__ . "/../app/controllers/web/profile.php";
require_once __DIR__ . "/../app/controllers/web/author/AuthorController.php";
require_once __DIR__ . "/../app/controllers/web/book/filterBook.php";
require_once __DIR__ . "/../app/controllers/web/admin/AdminController.php";
require_once __DIR__ . "/../app/controllers/web/cart/CartController.php";
require_once __DIR__ . "/../app/controllers/web/orders/DoneOreder.php";
require_once __DIR__ . "/../app/controllers/web/orders/cancelOrders.php";
require_once __DIR__ . "/../app/middlewares/AuthMiddleWare.php";
require_once __DIR__ . "/../app/middlewares/GuestMiddelware.php";



Route::get("", HomeController::class, "index");

Route::get("/auth/login", loginController::class, "index", [GuestMiddelware::class]);

Route::post("/auth/login", loginController::class, "login");

Route::get("/auth/logout", loginController::class, "logout", [AuthMiddleWare::class]);

Route::get("/auth/register", registerController::class, "index");

Route::post("/auth/register", registerController::class, "register");

Route::get("/profile", profileController::class, "index", [AuthMiddleWare::class]);

Route::post("/profile/editName", userController::class, "editName", [AuthMiddleWare::class]);

Route::post("/profile/editEmail", userController::class, "editEmail", [AuthMiddleWare::class]);

Route::post("/profile/editGender", userController::class, "editGender", [AuthMiddleWare::class]);

Route::post("/profile/editPassword", userController::class, "editPassword", [AuthMiddleWare::class]);

Route::post("/profile/AddAuthor", AuthorController::class, "addAuthor", [AuthMiddleWare::class]);

Route::post("/profile/filterBooks", bookFilter::class, "filterBooks", [AuthMiddleWare::class]);

Route::post("/profile/addBook", bookFilter::class, "addBook", [AuthMiddleWare::class]);

Route::post("/profile/banUser", AdminController::class, "banUser", ["AuthMiddleWare:admin"]);

Route::post("/profile/AddToCart", CartController::class, "addToCart", ["AuthMiddleWare:customer"]);

Route::post("/profile/getItemsIntoCart", CartController::class, "getItemsIntoCart", [AuthMiddleWare::class]);

Route::post("/profile/increaseOrderItem", CartController::class, "increaseOrderItem", ["AuthMiddleWare:customer"]);

Route::post("/profile/decreaseOrderItem", CartController::class, "decreaseOrderItem", ["AuthMiddleWare:customer"]);

Route::post("/profile/deleteOrderItem", CartController::class, "deleteOrderItem", ["AuthMiddleWare:customer"]);

Route::post("/profile/fireOrder", CartController::class, "fireOrder", ["AuthMiddleWare:customer"]);

Route::post('/profile/getOrderedOrders', CartController::class, 'getOrderedOrders', [AuthMiddleWare::class]);

Route::post('/profile/DoneOrders', doneOrderController::class, 'DoneOrder', [AuthMiddleWare::class]);

Route::post('/profile/getDoneOrdersList', CartController::class, 'getDoneOrdersList', [AuthMiddleWare::class]);

Route::post('/profile/CancelOrders', CancelOrderController::class, 'CancelOrder', [AuthMiddleWare::class]);
