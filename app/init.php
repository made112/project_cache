<?php
include "../app/core/app.php";
include "../app/core/Controller.php";
include "../app/core/helpers.php";
include "../app/core/config.php";
include "../app/core/db_config.php";
include "../app/core/database.php";
session_start();
spl_autoload_register(function ($class_name){
   $path =  "../app/models/" . ucfirst($class_name) . ".model.php";
   if($pos = strpos($path,"Test\\")){
       $path = substr_replace($path,'',$pos,4);
   }
   include_once $path;

});