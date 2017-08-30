
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8" />
    <title>Musicverse<?= ($title) ? " | " . $title : "" ?></title>
    <link rel="stylesheet" href="<?=URL_CSS?>index.css">
    <script type="text/javascript" src="<?=URL_JS?>jquery.min.js"></script>
    <script type="text/javascript" src="<?=URL_JS?>materialize.min.js"></script>
    <script type="text/javascript" src="<?=URL_JS?>jssor.slider-22.2.16.mini.js"></script>
    <script type="text/javascript">


        $(document).ready(function(){
            $('.carousel').carousel();
            $('.carousel.carousel-slider').carousel({
                fullWidth: true

            });

            $('select').material_select();
            $('.datepicker').pickadate({
                selectMonths: true, // Creates a dropdown to control month
                selectYears: 15 // Creates a dropdown of 15 years to control year
            });


        });


    </script>

    <link rel="shortcut icon" type="image/x-icon" href="<?=URL_IMG?>m-music.ico">
</head>

<body>
<!--Navigation bar link display-->
<nav>
    <div class="nav-wrapper">
        <a href="<?php echo $_SERVER["PHP_SELF"];?>" class="brand-logo center"><i class="fa fa-music"></i>Musicverse</a>
        <ul id="nav-mobile" class="left hide-on-med-and-down">
            <li><a href="<?=URL_HOME?>">Home</a></li>
            <li><a href="<?=URL_USERLOGIN?>">Login</a></li>
            <li><a href="<?=URL_USERREGISTER?>">Register</a></li>
        </ul>

        <?

            $cur_page= explode("/", $_SERVER['SCRIPT_NAME']);
       if(($cur_page[4]!="login.php")){ // OR ($cur_page[4]!="user_login.php") OR ($_GET["flag"] != true) OR ($cur_page[4]!= "user_register.php" )){
        $display = "<ul id='nav-mobile' class='right hide-on-med-and-down'>
            <li><a href='".URL_ADMIN."'>Admin</a></li>
            <li><a href='".URL_INDEX."'>Genres</a></li>
            <li><a href='".URL_CART."'>Cart</a></li>
            <li><a href='".URL_LOGOUT."' name ='logout' >Logout</a></li>
        </ul>";
        echo $display;

            }

            ?>
    </div>
</nav>