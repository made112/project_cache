<?php
class Controller{
    protected function view($view,$data = array()){
        extract($data);
        if(file_exists("../app/views/" . strtolower($view) . ".view.php")){
            include "../app/views/" . strtolower($view) . ".view.php";
        }
    }
    protected function redirect($view,$message = ""){
        header("location: "  . ROOT . $view);
    }
}