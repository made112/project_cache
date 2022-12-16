<?php
function show($data){
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}
function display_key($row){
    if($row && isset($row->key_value)){
        return $row->key_value;
    }
    return "";
}
function display_image($row,$key){
    if($row){
        if(isset($row[0]->image_path)){
            $path = str_replace("C:/xampp/htdocs",$_SERVER["REQUEST_SCHEME"] . "://" .  $_SERVER["SERVER_NAME"],$row[0]->image_path);
            return $path;
        }
    }
    return $key == "" ? "" : $_SERVER["REQUEST_SCHEME"] . "://" .  $_SERVER["SERVER_NAME"] . "/memcache/data/404.webp";
}
function getSizeUtilize($size){
    $db = new database();
    $query = "SELECT capacity FROM configuration";
    $data = $db->query($query);
    $capacity = $data[0]->capacity;
    if ($capacity == 0) {
        echo 'Divisor is 0';
    } else {
        $sizeUtilize = ($size / $capacity) * 100;
    //to be edited later
    if($sizeUtilize > 100){
        $sizeUtilize = 100;
    }
    return (int)$sizeUtilize;
    }
}