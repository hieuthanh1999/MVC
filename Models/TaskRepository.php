<?php

namespace MVC\Models;

use MVC\Models\TaskResourceModel;

class TaskRepository
{
    protected $taskResourceModel;

    public function __construct()
    {
        $this->taskResourceModel = new TaskResourceModel();
    }
    
    public function add($model)
    {
        return $this->taskResourceModel->save($model);
    }

    public function edit($model)
    {

        return $this->taskResourceModel->save($model);
    }

    public function delete($id)
    {
        return $this->taskResourceModel->delete($id);
    }

    public function get($id)
    {
        return $this->taskResourceModel->get($id);
    }

    public function getAll()
    {
        return $this->taskResourceModel->getAll();
    }
}
