<?php
// Data Base Config file
if($_SERVER['SERVER_ADDR']=="localhost"){
    // Production config DB
    define('HOST','localhost');
    define('DB_USER', 'root');
    define('DB_PASSWORD','root');
    define('DB_NAME','beeproject');
    define('DB_DRIVER','mysql');
    define('CHARSET','utf8');
}else{
    // Developer server
    define('HOST','localhost');
    define('DB_USER', 'root');
    define('DB_PASSWORD','root');
    define('DB_NAME','beeproject');
    define('DB_DRIVER','mysql');
    define('CHARSET','utf8');
}

