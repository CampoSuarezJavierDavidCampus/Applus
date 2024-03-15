<?php 
namespace Core\Interfaces\Router;
use Core\Enums\HTTP_Verbs;
interface IRouter{
    public function register_new_route(IRoute $route):IRoute;
    public function call_route(string $path, HTTP_Verbs $HTTP_Verbs);
}