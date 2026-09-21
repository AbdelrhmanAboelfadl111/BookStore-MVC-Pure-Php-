<?php
require_once __DIR__ . "/../../controller.php";
require_once __DIR__ . "/../../../../core/Request.php";
require_once __DIR__ . "/../../../../app/models/auth/auth.php";
class loginController extends Controller
{
    public function index()
    {
        $this->view("auth/login");
    }

public function login()
{
    $errors = Request::validate([
        'Email' => ['required', 'email'],
        'Password' => ['required'],
    ]);

    if (!empty($errors)) {
        returnBack();
    }

    $login = Auth::login();

    if ($login === 'banned') {

        $_SESSION['_errors']['invalid'][] =
            "Your account has been banned.";

        redirect('/auth/login');
    }

    if ($login === 'success') {
        session_regenerate_id(true);
        redirect('/profile');
    }

    $_SESSION['_errors']['invalid'][] = "Invalid Account";

    returnBack();
}


    public function logout(){
        unset($_SESSION['user']);
        session_regenerate_id(true);
        redirect('/auth/login');
    }
}
