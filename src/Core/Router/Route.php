<?php
namespace Core\Router;

use Core\Enums\HTTP_Verbs;
use Core\Interfaces\IRoute;

class Route implements IRoute{
    private string $_name;
    private HTTP_Verbs $_verb;    
    public function set_name(string $name):IRoute{
        $this->_name = $name;
        return $this;
    }
    public function set_HTTP_Verb(HTTP_Verbs $verb):IRoute{
        $this->_verb = $verb;
        return $this;
    }

    public function validate(string $name, HTTP_Verbs $verb): bool
    {
        return $this->_name == $name && $this->_verb == $verb;
    }

    public function render(callable $callback):string{
        //invocar a la funcion controller
        return "OK";
    }

}