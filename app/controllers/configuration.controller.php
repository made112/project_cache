<?php

class Configuration extends Controller{
    public function index(){
        $conf_data = new cache_configuration();
        $cache = new Cache();
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if(isset($_POST["clear"])){
                $cache->clear();
            }
            else{
                $capacity = $_POST["capacity"];
                $replacement_policy = $_POST["policy"];
                $conf_data->updateConfigCache($capacity,$replacement_policy);
                $cache->refreshConfiguration();
            }
        }
        $data["row"] = $conf_data->getConfiguration();
        $data["page_title"] = "configuration";
        $this->view("configuration", $data);
    }
}