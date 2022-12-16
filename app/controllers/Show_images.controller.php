<?php

class Show_images extends Controller{
    public $messages = array();
    public function index($key = ""){
        $db = new database();
        $status = false;
        $error = null;
        $KeyAndValue = new KeyAndImage($db);
        $cache = new Cache();
        $data["keyAndImage"] = false;
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $key = $_POST["key"];
        }
        $check = $KeyAndValue->validateKey($key);
        if($check) {
            $cache_status = $cache->get($key);
            //cache hit
            if($cache_status){
                $data["keyAndImage"]["cacheStatus"] = "hit";
                $data["keyAndImage"]["image"] = $cache_status;
                $status = "Cache Hit";
            }
            //cache miss
            else{
                $status = "Cache Miss";
                $row = $KeyAndValue->getKeyImagePair($key);
                if (!$row) {
                    $this->messages["key"] = "<div class='fail'>The Key You Entered Does Not exists</div>";
                }
                if (empty($this->messages)) {
                    if (isset($row)) {
                        $image = file_get_contents($row[0]->image_path);
                        $error = $cache->PUT($key,$image);
                        $data["keyAndImage"] = $row;
                    }
                }
            }

        }
        else{
            if($key != ""){
                $this->messages["valid-key"] = "<div class='fail'>Please Enter valid Key.</div>";
            }
        }
        $data["key"] = $key;
        $data["status"] = $status;
        $data["page_title"] = "Show-images";
        $data["messages"] = $this->messages;
        $data["error"] = $error;
        $this->view("show-images",$data);
    }
}