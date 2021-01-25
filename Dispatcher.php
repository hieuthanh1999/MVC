<?php

namespace MVC;

use MVC\Request;
use MVC\Router;

class Dispatcher
{
    private $request;

    public function dispatch()
    {
        $this->request = new Request();

        Router::parse($this->request->url, $this->request);
        $controller = $this->loadController();

        //Gọi các hàm có tên mà bạn không biết trước 
        call_user_func_array([$controller, $this->request->action], $this->request->params);
    }

    public function loadController()
    {
        $name = ucfirst($this->request->controller) . "Controller";
        $class = "MVC\\Controllers\\" . $name;

        $controller = new $class();
        return $controller;
    }
}
