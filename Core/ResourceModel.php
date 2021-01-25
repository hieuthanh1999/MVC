<?php

namespace MVC\Core;

use MVC\Config\Database;
use PDO;
use MVC\Core\ResourceModelInterface;


class ResourceModel implements ResourceModelInterface
{

    protected $tableName;
    protected $id;
    protected $model;

    //Khởi tạo dữ liệu mẫu, Data 
    public function _init($tableName, $id, $model)
    {
        $this->tableName = $tableName;
        $this->id        = $id;
        $this->model     = $model;
    }

    //Hàm tạo và cập nhập
    public function save($model)
    {
        //Khoi tao 2 mảng cho viec insert
        $keys = array();
        $values = array();

        //Khởi tạo 1 mảng lưu update
        $set = array();

        $id = $model->getId();
        //Chuyển oj thành arr
        $properties = $model->getProperties();
        //Định dạng ngày
        $properties['created_at'] = date('Y-m-d H:i:s');
        $properties['updated_at'] = date('Y-m-d H:i:s');

        //Thêm vào mảng các giá trị key của properties
        foreach ($properties as $key => $value) {
            array_push($keys, $key);
            array_push($values, $key);
            array_push($set, $key . ' = :' . $key);
        }
        //Nối các phần tử thành chuỗi
        $keys   = implode(', ', $keys);
        $values = implode(', :', $values);
        $set    = implode(', ', $set);

        if ($id == null) {
            //Loại bỏ biến id để lọc ra title...
            unset($properties['id']);
            $sql = "INSERT INTO $this->tableName ($keys) VALUES ($values)";
            $req = Database::getBdd()->prepare($sql);
            return $req->execute($properties);
        } else {
            $sql = "UPDATE $this->tableName SET $set WHERE id = :id";
            $req = Database::getBdd()->prepare($sql);
            return $req->execute($properties);
        }
    }

    //Hàm xóa theo id
    public function delete($id)
    {
        $sql = "DELETE FROM $this->tableName WHERE id = $id";
        $req = Database::getBdd()->prepare($sql);
        return $req->execute();
    }

    //Hàm lấy theo id
    public function get($id)
    {
        $sql = "SELECT * FROM $this->tableName Where id = $id";
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetch(PDO::FETCH_OBJ);
    }

    //Hàm hiển thị tất cả list trong tasks
    public function getAll()
    {
        $sql = "SELECT * FROM $this->tableName";
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_OBJ);
    }
}
