<?php

class Response{
    public static function error(string $msg, int $statues = 200):void{
        http_response_code($statues);
        echo $msg;
        exit;
    }
    public static function json_response(array $data, string $msg = "",int $statues=200) {
        header("Content-Type: application/json; charset=UTF-8");
        http_response_code($statues);
        echo json_encode([
            'message' => $msg,
            "data" => $data
        ]);
        exit();
    }
}