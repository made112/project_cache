<?php
class app{
    private $controller = "Home";
    private $method = "index";
    private $params = array();
    public function __Construct(){
        $url = $this->split_url();
        if(file_exists("../app/controllers/" . ucfirst($url[0]) . ".controller.php")){
            $this->controller = ucfirst($url[0]);
            unset($url[0]);
        }
        else{
            if($url[0] != ""){
                header("location: http://localhost/memcache/app/core/uploadStatistics.php");
            }
        }
        require "../app/controllers/" . $this->controller . ".controller.php";
        $this->controller = new $this->controller;
        if(isset($url[1])){
            if(method_exists($this->controller,$url[1])){
                $this->method = $url[1];
                unset($url[1]);
            }
        }
        $this->params = array_values($url);
        call_user_func_array([$this->controller,$this->method],$this->params);
    }
    private function split_url(){
        $url = isset($_GET["url"]) ? trim($_GET["url"],"/") : "";
        return explode("/",$url);

    }
}