<?php

namespace Mvc\Core;

class Model
{
    //Trả về mảng gồm thuộc tính của đối tượng
    public function getProperties()
    {
        return get_object_vars($this);
    }
}
