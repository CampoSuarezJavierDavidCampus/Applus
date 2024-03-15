<?php
use App\Controller\ProductController;
use Core\Enums\HTTP_Verbs;
use Core\Router\Route;


return [
    (new Route())
        ->set_name("")
        ->set_HTTP_Verb(HTTP_Verbs::GET)
        ->set_action(function (){
            return (new ProductController)->show();
        }
    )
];