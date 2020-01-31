<?php
    // We verify if cookie exits
    if(isset($HTTP_COOKIE_VARS['lang'])) {
        // If yes, we create $lang var with value of cookie
        $lang = $HTTP_COOKIE_VARS['lang'];
    } else {
        // If cookie doesn't exist, we try to recognize default language of used navigator
        $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,2);
    }
    // We define cookie duration(before that expiration)
    $expire = 365*24*3600;
    // We create cookie
    setcookie("lang", $lang, time() + $expire);
    switch($lang) {
        //If lang=fr, we include english traduction file
        case 'fr':
            include('../lang/lang-en.php');
        break;
        //If lang=en, we include english traduction file
        case 'en':
            include('../lang/lang-en.php');
        break;
        //If lang=pt, we include portuguese traduction file
        case 'pt':
            include('../lang/lang-pt.php');
        break;
    }
?>