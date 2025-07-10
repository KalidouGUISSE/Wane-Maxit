<?php
namespace App\Core;
// require_once '../config/core/middleware.php'; 

class Router{
    public static function resolve(array $routes) {
        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    //   var_dump($url);die;
        if (isset($routes[$url])) {
            $controllerName = $routes[$url]['controller'];
            $actionName = $routes[$url]['action'];

            // var_dump($actionName);die;
            // var_dump($controllerName);die;

            // $middlewares = $routes[$url]['middleware'];
            // foreach ($middlewares as $middleware) {
            //     $middleware();
            // }

            $controller = new $controllerName();
            $controller->$actionName();
        } else {
            $erreurController = new ErrorController();
            $erreurController->page404();  
        }
    }
}