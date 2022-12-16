<?php
session_start();
header("content-type: image/*");
echo $_SESSION["image"];