<?php
require_once __DIR__ . "/middleWare.php";
class GuestMiddelware implements middleWare{
    public function handle():void{
        if(isset($_SESSION['user'])){
            redirect('/profile');
            
        }
    }
}