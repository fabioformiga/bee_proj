<?php
// Data Base Config file
if($_SERVER['SERVER_ADDR']=="localhost"){
    // Production config DB
    define('HOST','localhost');
    define('DB_USER', 'beeproj');
    define('DB_PASSWORD','@Beeroot20');
    define('DB_NAME','beeproject_db');
    define('DB_DRIVER','mysql');
    define('CHARSET','utf8');
}else{
    // Developer server
    define('HOST','localhost');
    define('DB_USER', 'beeproj');
    define('DB_PASSWORD','@Beeroot20');
    define('DB_NAME','beeproject_db');
    define('DB_DRIVER','mysql');
    define('CHARSET','utf8');
}

