<?php
require_once  "main/starter/page_start.php";
require_once "main/starter/functions.php";

//Destroy Session and Cookie with this function , used in this temporary page
if (isset($_SERVER['HTTP_COOKIE'])) {
    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
    foreach ($cookies as $cookie) {
        $parts = explode('=', $cookie);
        $name = trim($parts[0]);
        setcookie($name, "", time() - 1000);
        setcookie($name, "", time() - 1000, '/');
    }
}

$expire = time() - 60*10;
$path = "/~ha2703/756/Project1/"; // path to homepage
$domain = "kelvin.ist.rit.edu";
$secure = false; // accessible on HTTP (not just HTTPS)
$http_only = false; // accessible to js

setcookie("loggedIn","",$expire,$path,$domain,$secure,$http_only);
if (isset($_SESSION) && $_SESSION['loggedIn']== true) {
    header("LOCATION:" . URL_USERLOGIN . "?flag=true");
}
else{

    header("LOCATION:" . URL_USERLOGIN);
}

?>