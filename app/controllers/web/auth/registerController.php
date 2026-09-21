<?php
require_once __DIR__ . "/../../controller.php";
require_once __DIR__ . "/../../../helpers/Helpers.php";
require_once __DIR__ . "/../../../models/user/userModel.php";
class registerController extends Controller{
    public function index(){
        $this->view("auth/register");
    }
    public function register(){
        $errors = Request::validate([
            'Role' => ['required'],
            'Gender' => ['required'],
            'Username' => ['required'],
            'Email' => ['required','email',['unique','users']],
            'Password' => ['required',['min',8]],
            'Phone' => ['required', 'egPhone', ['unique', 'users']],
        ]);

        if(!empty($_SESSION['_errors'])){
            returnBack();
        }

        if(Request::DataSpecific('Role') == 'admin' && !isAuth('admin')){
            $_SESSION['_errors']['invalid'][]= "You Must To Login As Admin";
            returnBack();
        }

        userModel::createUser();

        $newUser = Request::DataSpecific('Role');

        $_SESSION['_success']['success'] = "New {$newUser} Created Successfully";

        redirect('/auth/login');
    }
}