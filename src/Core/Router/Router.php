<?php
namespace Core\Router;

use Core\Enums\HTTP_Verbs;
use Core\Interfaces\IRoute;

class Router{
    private array $_routes;
    public function register_new_route(IRoute $route):IRoute{
        return $this->_routes[] = $route;
    }

    public function call_route(string $path, HTTP_Verbs $HTTP_Verbs):string{
        foreach($this->_routes as $route){
            if($route->validate( $path, $HTTP_Verbs)){
                //call to controller
            }
        }
        return "page no found";
    }
}