<?php
require_once __DIR__ . "/../Model.php";
require_once __DIR__ . "/../../../core/DataBase.php";
require_once __DIR__ . "/../../../core/Request.php";

class Auth extends Model
{

public static function login():string
{
    $DB = Database::getConnection();

    $email = Request::DataSpecific('Email');
    $password = Request::DataSpecific('Password');

    $stmt = $DB->query("SELECT * FROM users WHERE email = '{$email}'; ");

    $result = $stmt->fetch();

    if (!empty($result)) {

        if (password_verify($password, $result['password'])) {

            if ((int)$result['is_banned'] === 1) {
                return 'banned';
            }

            $_SESSION['user'] = $result;

            return 'success';
        }
    }

    return 'invalid';
}

}
