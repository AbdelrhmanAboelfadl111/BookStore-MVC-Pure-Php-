<?php

class App
{
    public static function Run()
    {
        session_start();
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $type = str_starts_with($path, BaseUrl . "/api") ? 'api' : 'web';
        if ($type === "api") {
            header('content-Type: application/json; charset=UTF-8');
            header('Access-control-Allow-Origin: *');
            header('Access-Control-Allow-Methods:GET, POST, PATCH, DELETE');
            header('Access-Control-Headers: Content-Type,Authorization');
        };
        require_once __DIR__ . "/Route.php";
        require_once __DIR__ . "/../routes/{$type}.php";
        require_once __DIR__ . "/../app/helpers/Helpers.php";
        require_once __DIR__ . "/../core/response.php";
        require_once __DIR__ . "/../core/Request.php";
        require_once __DIR__ . "/../core/Validation.php";
        Route::dispatch();
    }
}
