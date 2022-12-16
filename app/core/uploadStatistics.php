<?php

include_once ("database.php");
include("../models/Cache.model.php");
include_once("config.php");
include_once("db_config.php");
session_start();
$db = new database();
$Cache = new Cache();
$data =  $Cache->getStatistics();
if($data["numberOfRequest"] != 0){
    $data["cache_hits"] = ($data["cache_hits"]/$data["numberOfRequest"]) * 100;
    $data["cache_miss"] = ($data["cache_miss"]/ $data["numberOfRequest"]) * 100;
}
$d =  isset($_GET["date"]) ? $_GET["date"] : date("y-m-d H:i:s");
$sql = "INSERT INTO statistics (number_of_items_in_cache,number_of_requests_made,total_size,miss_rate,hit_rate)
                    values(:numberOfItems,:numberOfRequest,:size,:cache_miss,:cache_hits)";
$db->query($sql,$data);
echo ":HI";