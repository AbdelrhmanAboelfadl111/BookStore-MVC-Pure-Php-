<?php

class Request{
    public static function allRequests():array{

        $json = json_decode(file_get_contents('php://input'),true);

        $allData = array_merge(
            $_GET,
            $_POST,
            is_array($json) ? $json : []
        );
        unset($allData['url']);
        return $allData;
    }

    public static function DataSpecific(string $key, mixed $default = null): mixed
    {
        return self::allRequests()[$key] ?? $default;
    }

    public static function validate(array $rules):array{
        $validator = new Validation(self::allRequests(),$rules);

        $errors = $validator->validate();

        $_SESSION['_errors'] = $errors;

        $_SESSION['_old'] = self::allRequests();

        return $errors;
    }

    public static function hasFile(string $fileName){
        return isset($_FILES[$fileName]) && $_FILES[$fileName]['tmp_name'] != "";
    }

    public static function file(string $fileName)
    {
        return $_FILES[$fileName];
    }
}