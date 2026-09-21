<?php
require_once __DIR__ . "../../../controller.php";
// require_once __DIR__ . "/../../models/DB/DBModel.php";
// require_once __DIR__ . "/../../models/orders/orderModel.php";
// require_once __DIR__ . "/../../models/Books/BookModel.php";
require_once __DIR__ . "/../../../../core/Request.php";
require_once __DIR__ . "/../../../../app/models/user/userModel.php";


class userController extends Controller{

    public function editName()
    {
        $errs = Request::validate([
            'editName' => ['required']
        ]);

        if (!empty($errs)) {
            returnBack('editError', $errs['editName'][0]);
        }

        $name = Request::DataSpecific('editName');

        userModel::editUser('name', $name);

        $_SESSION['user']['name'] = $name;

        returnBack('editSuccess', 'Name updated successfully');
    }

    public function editEmail()
    {
        $errs = Request::validate([
            'editEmail' => ['required', 'email']
        ]);

        if (!empty($errs)) {
            returnBack('editError', $errs['editEmail'][0]);
        }

        $email = Request::DataSpecific('editEmail');

        userModel::editUser('email', $email);

        $_SESSION['user']['email'] = $email;

        returnBack('editSuccess', 'Email updated successfully');
    }

    public function editGender()
    {
        $errs = Request::validate([
            'editGender' => ['required']
        ]);

        if (!empty($errs)) {
            returnBack('editError', $errs['editGender'][0]);
        }

        $gender = Request::DataSpecific('editGender');

        userModel::editUser('gender', $gender);

        $_SESSION['user']['gender'] = $gender;

        returnBack('editSuccess', 'Gender updated successfully');
    }

    public function editPassword()
    {
        $errs = Request::validate([
            'editPassword' => ['required', ['min', 8]]
        ]);

        if (!empty($errs)) {
            returnBack('editError', $errs['editPassword'][0]);
        }

        userModel::editUser(
            'password',
            Request::DataSpecific('editPassword')
        );

        returnBack('editSuccess', 'Password updated successfully');
    }
}