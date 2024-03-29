<?php
use Api\Controller\ProductController;
use Core\Enums\HTTP_Verbs;
use Core\Router\Route;


return [
    Route::factory(
        "product", HTTP_Verbs::GET,
        fn ()=>(new ProductController)->show()
    ),
    Route::factory(
        "product", HTTP_Verbs::POST,
        fn ()=>(new ProductController)->create()
    ),
    Route::factory(
        "product", HTTP_Verbs::PUT,
        fn ()=>(new ProductController)->edit()
    ),
    Route::factory(
        "product", HTTP_Verbs::DELETE,
        fn ()=> (new ProductController)->delete()
    )
];