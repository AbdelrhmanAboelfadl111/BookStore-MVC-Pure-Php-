<?php

class Route{
    private static array $Routes=[];

    public static function get(string $url,string $controller,string $action ,array $middlewares = []):void{
        self::$Routes[]=[
            "url"=>$url,
            "method"=>"GET",
            "controller"=>$controller,
            "action"=>$action,
            "middlewares" => $middlewares
        ];
    }
    public static function post(string $url, string $controller, string $action, array $middlewares = []): void{
        self::$Routes[] = [
            "url" => $url,
            "method" => "POST",
            "controller" => $controller,
            "action" => $action,
            "middlewares" => $middlewares
        ];
    }
    public static function getRoutes():array{
        return self::$Routes;
    }
    public static function dispatch(){
        $url=rtrim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH),"/");
        if($url == ""){
            $url="/";
        }
        $method=$_SERVER['REQUEST_METHOD'];

        $flag = false;


        foreach(self::$Routes as $route){
            $args= $args = self::matchRoute(
                BaseUrl . $route['url'],
                $url
            );
            if(is_array($args)){
                if ($method !== $route['method']) {
                    $flag = true;
                    continue;
                    
                }
                $flag = false;
                self::handelMiddleWare($route['middlewares']);
                $obj = new $route['controller']();
                $obj->{$route['action']}(...$args);
                return;
            }
            
        }
        if($flag){
            http_response_code(405);
            echo "404 Not Allowed {$route['method']}";
            return;
        }
        http_response_code(404);
        echo "404 Not Found";
    }
    public static function matchRoute(string $route,string $url): false | array{
        $regex="/\{[A-Za-z_][A-Za-z_0-9]*\}/";
        $pattern=preg_replace($regex,"([^/]+)",$route);
        $pattern="#^{$pattern}$#";
        if(!preg_match($pattern,$url,$matches)){
            return false;
        }
        unset($matches[0]);
        return $matches;
    }

    private static function handelMiddleWare(array $middlewares):void{
        foreach($middlewares as $middleware){
            $args=[];
            if(str_contains($middleware,":")){
                $arr = explode(":", $middleware);

                $middleware = $arr[0];
                $args = explode(",", $arr[1]);
            }
            (new $middleware())->handle(...$args);
        }
    }

}