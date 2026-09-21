<?php

class Controller{
    protected function view(string $viewpath,$data=[]){
        extract($data);
        require_once __DIR__ . "/../views/{$viewpath}.php";
    }
}