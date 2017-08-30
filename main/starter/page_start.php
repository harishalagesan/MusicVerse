<?php

    session_name( "KillingJoke" );
    session_start();

    define( "PATH_BASE" , "/home/ha2703/Sites/756/Project1/main/" );
    define( "PATH_JS" , PATH_BASE . "js/" );
    define( "PATH_CSS", PATH_BASE . "css/" );
    define( "PATH_IMG", PATH_BASE . "images/" );
    define( "PATH_GENRES", PATH_BASE . "genres/" );

    define("URL_BASE", "http://kelvin.ist.rit.edu/~ha2703/756/Project1/main/");
    define("URL_BASE1", "http://kelvin.ist.rit.edu/~ha2703/756/Project1/");
    define("URL_BASE2", "http://kelvin.ist.rit.edu/~ha2703/756/Project1/main/starter");
    define("URL_JS", URL_BASE . "js/");
    define("URL_CSS", URL_BASE . "css/");
    define("URL_IMG", URL_BASE . "images/");
    define("URL_USERLOGIN",URL_BASE1."user_login.php");
    define("URL_INDEX",URL_BASE1."index.php");
    define("URL_USERREGISTER",URL_BASE1."user_register.php");
    define("URL_PRODUCT", URL_BASE1 . "product.php");
    define("URL_CART", URL_BASE1 . "cart.php");
    define("URL_HOME", URL_BASE1 . "login.php");
    define("URL_ADMIN", URL_BASE1 . "admin.php");
    define("URL_LOGOUT", URL_BASE1 . "logout.php");
    define("URL_CHECKOUT", URL_BASE1 . "checkout.php");


?>