<?php
require_once __DIR__ . "/../../controller.php";
require_once __DIR__ . "/../../../models/author/AuthorModel.php";


class AuthorController extends Controller
{
    public function addAuthor(){

    $errors = Request::validate([
            'authorName' => ['required'],
            'authorBio' => ['required']
    ]);

    if(!empty($errors)){
        Response::json_response($errors,"Unprocessable Entity",422);
    }

        $newAuthor = AuthorModel::addAuthor();

        Response::json_response($newAuthor,"Add success");
    }
}
