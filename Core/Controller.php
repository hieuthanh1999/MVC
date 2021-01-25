<?php

namespace MVC\Core;

class Controller
{
    var $vars = [];
    var $layout = "default";

    //Truyền giá trị từ model ra views
    function set($d)
    {
        $this->vars = array_merge($this->vars, $d);
    }

    //Trộn dữ liệt đã truyền sang với mã Html
    function render($filename)
    {
        extract($this->vars);
        ob_start();

        //Lấy ra view tasks
        $url = str_replace('Controller', '', get_class($this));
        $url = str_replace("MVC\s", '', $url);
        $url = ltrim($url, '\\');

        require(ROOT . "Views/" . $url . '/' . $filename . '.php');


        $content_for_layout = ob_get_clean();

        if ($this->layout == false) {
            $content_for_layout;
        } else {
            require(ROOT . "Views/Layouts/" . $this->layout . '.php');
        }
    }

    private function secure_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    protected function secure_form($form)
    {
        foreach ($form as $key => $value) {
            $form[$key] = $this->secure_input($value);
        }
    }
}
