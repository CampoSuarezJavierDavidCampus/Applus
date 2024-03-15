<?php
require_once('../vendor/autoload.php');
use Core\Enums\HTTP_Verbs;
use Core\Router\Router;
//!Catch method
$method = match($_SERVER["REQUEST_METHOD"]){
    'GET'=>HTTP_Verbs::GET,
    'POST'=>HTTP_Verbs::POST,
    'PUT'=>HTTP_Verbs::PUT,
    'DELETE'=>HTTP_Verbs::DELETE,
};
//! Router
$uri = explode('?',trim(strtolower($_SERVER["REQUEST_URI"]),'/'))[0];
$router = Router::CreateRouter();
$res = $router->call_route($uri,$method);

header('Content-Type: application/json');
echo json_encode($res);


