<?php

namespace MVC\Core;

interface ResourceModelInterface
{
    //Khai báo các phương thức
    public function _init($nameTable, $id, $modelName);
    public function save($modelName);
    public function delete($id);
    public function get($id);
    public function getAll();
}
