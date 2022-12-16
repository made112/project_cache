<?php


class Upload extends Controller{
    public function index(){
        $db = new database();
        $ErrorMessages = array();
        $success = "";
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $key = $_POST["key"];
            $image = $_FILES["img"];
            $keyAndImage = new KeyAndImage($db);
            $isValidKeyAndImage = $keyAndImage->validateKeyAndImage($key,$image);
            if($isValidKeyAndImage !== true){
                $key = array_keys($isValidKeyAndImage);
                $ErrorMessages[$key[0]] = $isValidKeyAndImage[$key[0]];

            }
            if(empty($ErrorMessages)){
                $status = $keyAndImage->processData($key,$image);
                if($status == "added" || $status == "updated"){
                    $success = $status == "added" ? "data Added Successfully" : "data updated successfully";
                }
                if($status == "updated"){
                    $cache = new Cache();
                    $cache->InvalidateKey($key);
                }
            }
        }
        $data["success"] = $success;
        $data["messages"] = $ErrorMessages;
        $data["page_title"] = "upload";
        $this->view("upload",$data);
    }
}