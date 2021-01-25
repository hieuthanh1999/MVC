<?php

namespace MVC;

class Router
{
    //Băm url ra làm từng phần
    static public function parse($url, $request)
    {
        //Chuyển url sang chữ hoa và xóa khoảng trắng
        $url = strtoupper(trim($url));
        //Nếu url = /MVC. thì gán các các thuộc tính
        if ($url == "/MVC/") {
            $request->controller = "tasks";
            $request->action = "index";
            $request->params = [];
        } else {
            //Tách chuỗi url và chia chuỗi '/'
            $explode_url = explode('/', $url);
            //cắt bỏ phần tử và giữ lại từ vị trí thứ 2
            $explode_url = array_slice($explode_url, 2);
            $request->controller = $explode_url[0];
            $request->action = $explode_url[1];
            $request->params = array_slice($explode_url, 2);
        }
    }
}
