<?php
namespace Core\Router;

use Core\Enums\HTTP_Verbs;
use Core\Interfaces\Router\IRoute;
use Core\Interfaces\Router\IRouter;

class Router implements IRouter{
    static private IRouter|null $router = null;

    private array $_routes;

    private function __construct() { 
        $this->_routes = require_once('Routes.php');
        
    }

    static function CreateRouter():IRouter{
        if (is_null(self::$router)) {
            self::$router = new Router();
        }
        return self::$router;
    }

    public function register_new_route(IRoute $route):IRoute{
        return $this->_routes[] = $route;
    }

    public function call_route(string $path, HTTP_Verbs $HTTP_Verbs){
        
        foreach($this->_routes as $route){
                       
            if($route->validate( $path, $HTTP_Verbs)){
                return $route->get_action();
            }
        }
        return "page no found";
    }
}