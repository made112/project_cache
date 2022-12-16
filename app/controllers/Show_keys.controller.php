<?php
class Show_keys extends Controller{
    public function index(){
        $db = new database();
        $keyAndValue = new KeyAndImage($db);
        $data["keys"] = $keyAndValue->getAllKeys();
        $data["page_title"] = "Show-Keys";
        $this->view("show-keys",$data);
    }
}