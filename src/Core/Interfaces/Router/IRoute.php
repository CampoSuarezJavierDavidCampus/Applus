<?php
namespace Core\Interfaces\Router;

use Core\Enums\HTTP_Verbs;
use IRender;

interface IRoute{
    public function set_name(string $name):IRoute;
    public function set_HTTP_Verb(HTTP_Verbs $verb):IRoute;
    public function set_action(callable $callback):IRoute;
    public function get_action();
    public function validate(string $name, HTTP_Verbs $verb):bool;
}