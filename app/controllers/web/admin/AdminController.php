
<?php
require_once __DIR__ . "/../../controller.php";
require_once __DIR__ . "/../../../../core/Request.php";
require_once __DIR__ . "/../../../../app/models/admin/admin.php";
class AdminController extends Controller
{
    public function banUser(){

        $errors = Request::validate([
            'userId' => ['required',['exists','users','id']]
        ]);
        if(!empty($errors)){
            Response::json_response($errors,"",422);
        }
        adminModel::banUser();
    }
}

