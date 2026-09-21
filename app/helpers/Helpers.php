<?php

function printPre(mixed $data,bool $die = false):void{
    echo "<pre>";
    print_r(json_encode($data));
    echo "<pre>";
    if($die){
        exit;
    }
};

function asset(string $path){
    return BaseUrl . "/assets/" .ltrim($path,"/");
};

function session(string $key ,mixed $value = null):mixed{
    //Getter
    if(func_num_args() === 1){
        return $_SESSION[$key] ?? null;
    }
    //setter
    $_SESSION[$key] = $value;

    return $_SESSION[$key];
};

function old(string $key,mixed $default = ''):mixed{
    return $_SESSION['_old'][$key] ?? $default;
};

function isAuth(?string $key = null): bool
{
    if (!isset($_SESSION['user'])) {
        return false;
    }

    if ($key === null) {
        return true;
    }

    return ($_SESSION['user']['role'] ?? null) === $key;
}

function auth(?string $key = null):mixed{
    $user = $_SESSION['user'] ?? null;
    if($key === null){
        return $user;    
    }
    return $user[$key]??null;
};

function isGuest():bool{
    return !isAuth();
};

function redirect(string $path){
    $url = BaseUrl . $path;
    header("location: {$url}");
    exit;
};

function route(string $path){
    return BaseUrl . $path;
}
function returnBack(?string $key = null, ?string $msg = "")
{
    $path = $_SERVER['HTTP_REFERER'];

    if($key !== null){
        $_SESSION['_success'][$key] = $msg;
    }

    header("Location: {$path}");
    exit;
}
function getErrors(string $key)
{
    $htmlErr = "";

    if (isset($_SESSION['_errors'][$key])) {
        $htmlErr = "<p class='alert alert-danger mb-0 mt-2'>{$_SESSION['_errors'][$key][0]}</p>";
        unset($_SESSION['_errors'][$key]);
    }

    return $htmlErr;
}
function getOld(string $key)
{

    $oldValue = $_SESSION['_old'][$key] ?? '';
    unset($_SESSION['_old'][$key]);
    return $oldValue;
}

function getSuccess(string $key)
{
    $htmlSuccess = "";

    if (isset($_SESSION['_success'][$key])) {

        $htmlSuccess = "<p class='alert alert-success mb-0 mt-2'>
            {$_SESSION['_success'][$key]}
        </p>";

        unset($_SESSION['_success'][$key]);
    }

    return $htmlSuccess;
}
function getFlash(string $key)
{
    $message = $_SESSION['_success'][$key] ?? null;

    unset($_SESSION['_success'][$key]);

    return $message;
}