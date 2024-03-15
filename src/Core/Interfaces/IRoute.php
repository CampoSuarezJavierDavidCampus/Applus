<?php
namespace Core\Interfaces;

use Core\Enums\HTTP_Verbs;
use IRender;

interface IRoute extends IRender{
    public function set_name(string $name):IRoute;
    public function set_HTTP_Verb(HTTP_Verbs $verb):IRoute;
    public function validate(string $name, HTTP_Verbs $verb):bool;
}