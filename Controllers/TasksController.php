<?php

namespace MVC\Controllers;

use MVC\Core\Controller;
use MVC\Models\TaskRepository;
use MVC\Models\TaskModel;

class TasksController extends Controller
{
    private $tasks;
    private $model;

    public function __construct()
    {
        $this->tasks = new TaskRepository();
        $this->model = new TaskModel();
    }

    //Show 1 list tasks
    public function index()
    {
        $d['tasks'] = $this->tasks->getAll();
        $this->set($d);
        $this->render("index");
    }

    //Tạo 1 list tasks
    public function create()
    {
        if (isset($_POST["title"])) {
            $this->model->setTitle($_POST['title']);
            $this->model->setDescription($_POST['description']);
            if ($this->tasks->add($this->model)) {
                header("Location: " . WEBROOT . "tasks/index");
            }
        }
        $this->render("create");
    }

    //Cập nhập 1 tasks
    public function edit($id)
    {
        $d["tasks"] = $this->tasks->get($id);

        if (isset($_POST["title"])) {
            //Set các thuộc tính
            $this->model->setId($id);
            $this->model->setTitle($_POST['title']);
            $this->model->setDescription($_POST['description']);

            if ($this->tasks->edit($this->model)) {
                header("Location: " . WEBROOT . "tasks/index");
            }
        }
        $this->set($d);
        $this->render("edit");
    }

    //Xóa tasks
    public function delete($id)
    {
        if ($this->tasks->delete($id)) {
            header("Location: " . WEBROOT . "tasks/index");
        }
    }
}
