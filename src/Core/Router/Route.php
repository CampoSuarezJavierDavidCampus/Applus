<?php
namespace Core\Router;

use Core\Enums\HTTP_Verbs;
use Core\Interfaces\Router\IRoute;

class Route implements IRoute{
    private string $_name;
    private HTTP_Verbs $_verb;   
    private  $action ;   

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

    public function set_action(callable $callback):IRoute{
        $this->action = $callback;
        return $this;
    }

    public function get_action(){

        return call_user_func($this->action);
    }

}