<?php
class KeyAndImage{
    public database $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function validateKey($key){
        $key = trim($key);
        if(preg_match("/^[a-zA-Z0-9@#$&]+$/",$key) && strlen($key) <= 60){
            return true;
        }
        return false;
    }
    private function validateImage($image){
        if(!isset($image["name"]) || $image["name"] == ""){
            return "<div class='fail'>No Image is selected</div>";
        }
        $image_info = getimagesize($image["tmp_name"]);
        if(!$image_info){
            return "<div class='fail'>Images are allowed only</div>";
        }
        return true;
    }
    public function isImageExists($path){
        $check = $this->getFileSystemReady();
        if($check !== true){
            return $check;
        }
        $query = "SELECT image_path FROM cache_data WHERE image_path = :path";
        $data =  $this->db->query($query,["path"=>$path]);
        if(is_array($data) && !empty($data)){
            return true;
        }
        return false;

    }
    private function upload_to_file_system($source_path,$destination_path,$key = ""){
        $check =  move_uploaded_file($source_path,$destination_path);
        if(!$check){
            return ["file-system"=>"<div class='fail'>failed to write to file system</div>"];
        }
        if($key != ""){
            $file_name = $this->getImagePath() . $key . ".txt";
            $myfile = fopen($file_name, "w");
            if(!$myfile){
                return ["file-system"=>"<div class='fail'>failed to write to file system</div>"];
            }
            $txt = $destination_path . "\n";
            fwrite($myfile, $txt);
            fclose($myfile);
        }
        return true;
    }
    private function checkIfValueExists($key){
        $query = "SELECT * FROM cache_data WHERE key_value = :key";
        $array["key"] = $key;
        $data = $this->db->query($query,$array);
        if(!$data | empty($data)){
            return true;
        }
        return $data;
    }
    private function addToDatabase($key,$path){
        $data = $this->checkIfValueExists($key);
        if(!is_array($data)){
            $this->add($key,$path);
            return "added";
        }
        else{
            $this->update($key,$path,$data);
            return "updated";
        }
    }
    public function add($key,$path){
        $sql = "INSERT INTO cache_data (key_value,image_path) VALUES(:key,:path)";
        $array["key"] = $key;
        $array["path"] = $path;
        $this->db = new database();
        $this->db->query($sql,$array);
    }
    public function update($key,$path,$data){
        if(file_exists($data[0]->image_path)){
            unlink($data[0]->image_path);
        }
        $sql = "UPDATE cache_data SET image_path = :path WHERE  key_value = :key";
        $data = null;
        $data["key"] = $key;
        $data["path"] = $path;
        $this->db->query($sql,$data);
    }
    public function getAllKeys($order = "desc"){
        $query = "SELECT * FROM cache_data ORDER BY id $order";
        $data = $this->db->query($query);
        if(is_array($data)){
            return $data;
        }
        return false;
    }
    public function getKeyImagePair($key){
        $query = "SELECT key_value,image_path FROM cache_data WHERE key_value = :key";
        $data = $this->db->query($query,["key"=>$key]);
        if(is_array($data) && !empty($data)){
            return $data;
        }
        return false;
    }
    public function validateKeyAndImage($key,$image){
        $isValidKey = $this->validateKey($key);
        if(!$isValidKey){
            return ["key" =>"<div class='fail'>Key must consist only of characters and numbers and [@ , # , $ , &]</div>"];
        }
        $isValidImage = $this->validateImage($image);
        if($isValidImage !== true){
            return ["image"=>$isValidImage];
        }
        return true;
    }
    public function processData($key,$image){
        $check = $this->getFileSystemReady();
        if($check !== true){
            return $check;
        }
        $isUnique = true;
        while($isUnique){
            $dst_path = $this->CreateUniqueImage($image);
            $isUnique = $this->isImageExists($dst_path);
        }
        $source_path = $image["tmp_name"];
        $check = $this->upload_to_file_system($source_path,$dst_path);
        if($check !== true){
            return $check;
        }
        $check = $this->addToDatabase($key,$dst_path);
        return $check;

    }
    private function getImagePath(){
        return  $_SERVER["DOCUMENT_ROOT"] . "/memcache/data";
    }
    private function CreateUniqueImage($image){
        $elements = explode(".",$image["name"]);
        $ext = $elements[1];
        $name = $elements[0];
        $path = $this->getImagePath() . '/' . $name . rand(1111,9999) . "." . $ext;
        return $path;
    }
    private function createImagePath(){
        $check = mkdir($this->getImagePath());
        return $check;
    }
    private function getFileSystemReady(){
        if(!file_exists($this->getImagePath())){
            $check = $this->createImagePath();
            if($check !== true){
                return ["file-System" => "<div class='fail'>File System Error</div>"];
            }
        }
        return true;
    }
}