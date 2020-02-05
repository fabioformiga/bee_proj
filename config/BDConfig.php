<?php
// Data Base Config file
if($_SERVER['SERVER_ADDR']=="localhost"){
    // Production config DB
    define('HOST','localhost');
    define('DB_USER', 'root');
    define('DB_PASSWORD','pt123PT#'); //pt123PT#
    define('DB_NAME','beeproject_db');
    define('DB_DRIVER','mysql');
    define('CHARSET','utf8');
}else{
    // Developer server
    define('HOST','localhost');
    define('DB_USER', 'root');
    define('DB_PASSWORD','pt123PT#'); //pt123PT#
    define('DB_NAME','beeproject_db');
    define('DB_DRIVER','mysql');
    define('CHARSET','utf8');
}
