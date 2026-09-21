<?php
require_once __DIR__ . "/middleWare.php";
class AuthMiddleWare implements middleWare{

    #[Override]
    public function handle(string ...$roles): void
    {

        if(!isset($_SESSION['user'])){
            redirect('/auth/login');
        }
        if(empty($roles)){
            return;
        }
        $currentRoleAuth = $_SESSION['user']['role'];

        if(!in_array($currentRoleAuth,$roles)){
            http_response_code(403);
            exit("Forbidden");
        }
    }

}