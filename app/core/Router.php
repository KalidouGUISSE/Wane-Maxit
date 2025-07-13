<?php
namespace App\Core;

use App\Core\Middlewares\Auth;
use Src\controller\ErrorController;

class Router {
    public static function resolve(array $routes) {
        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        if (isset($routes[$url])) {
            $controllerName = $routes[$url]['controller'];
            $actionName = $routes[$url]['action'];

            // Charger la config des middlewares
            $middlewaresConfig = require_once __DIR__ . '/../config/middlewares.php';
            $middlewares = $routes[$url]['middleware'] ?? [];
            foreach ($middlewares as $middlewareKey) {
                // var_dump('ads');die;
                if (isset($middlewaresConfig[$middlewareKey])) {
                    $middlewareClass = $middlewaresConfig[$middlewareKey];
                    (new $middlewareClass())(); // Appelle __invoke()
                }
            }

            $controller = new $controllerName();
            $controller->$actionName();
        } else {
            $erreurController = new ErrorController();
            $erreurController->page404();  
        }
    }
}
