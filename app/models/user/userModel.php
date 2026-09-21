<?php
require_once __DIR__ . "/../Model.php";
require_once __DIR__ . "/../../../core/DataBase.php";
require_once __DIR__ . "/../../../core/Request.php";

class userModel extends Model
{


    public static function createUser()
    {
        $data = Request::allRequests();
        $hashPass = password_hash($data['Password'], PASSWORD_DEFAULT);
        $DB = Database::getConnection();
        $DB->exec("INSERT INTO users 
        (name, email, password, phone, gender, role) 
        VALUES 
        (
            '{$data['Username']}',
            '{$data['Email']}',
            '{$hashPass}',
            '{$data['Phone']}',
            '{$data['Gender']}',
            '{$data['Role']}'
        )");
    }

    public static function editUser(string $column,string $value){
        $DB = Database::getConnection();
        $authId = auth('id');
        if($column == 'password'){
            $value = password_hash($value,PASSWORD_DEFAULT);
        }

        $DB -> exec("UPDATE users SET {$column} = '{$value}' WHERE id = '{$authId}'");
    }
}
