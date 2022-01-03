<?php 
session_start();



// connect db 
    Database::connectDB('localhost', 'minima_db' , 'root', '');


define('PROTOCAL','http');
$path = str_replace("\\", "/",PROTOCAL ."://"  . $_SERVER['SERVER_NAME'] . ':8080'. __DIR__  . "/");
$path = str_replace($_SERVER['DOCUMENT_ROOT'], "", $path);

define('ROOT', str_replace("app/core", "public", $path));
define('ASSETS', str_replace("app/core", "public/assets", $path));

?>