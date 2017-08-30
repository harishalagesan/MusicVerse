<?php
$title="Genres";
require_once  "main/starter/page_start.php";
require_once "main/starter/functions.php";
require "main/classes/DB.class.php";

require_once "main/starter/header.php";
$db = DB::getInstance();

//valid user check
    $validuser = "SELECT * FROM session WHERE sessionID=?";
    $input = array(session_id());
    $data = array("s");

    $db ->do_query($validuser,$input,$data);
    $result = $db->fetch_all_array();

    foreach ($result as $new){

        $requested_result = $new[0]['sessionID'];

    }

    //check for right user with session
    if((!isset($_SESSION["loggedIn"]) or $_SESSION["loggedIn"] == false) && empty($requested_result)){

        header("LOCATION:" . URL_USERLOGIN);
    }

    if(!empty($_GET["submit"]))
    {
       header("Location:" . URL_PRODUCT."?page=".$_GET['submit']);
    }
?>
        <div class = "genre">

            <h4 class="teal-text" style="padding-left: 17em">Pick a genre to shop from!!</h4>
            <form name="input" action="<?php echo $_SERVER["PHP_SELF"];?>" method="GET">
            <button class = "rock_class" type="submit" name="submit" value ="rock"></button>
            <button class = "jazz_class" type="submit" name="submit" value ="jazz" ></button>
            <button class = "trance_class" type="submit" name="submit" value = "trance"></button>
            <button class = "hiphop_class" type="submit" name="submit" value = "hiphop"></button>
            <button class = "blues_class" type="submit" name="submit" value ="blues"></button>
            <button class = "pop_class" type="submit" name="submit" value ="pop"></button>
            <button class = "deathmetal_class" type="submit" name="submit" value="deathmetal"></button>
            <button class = "rap_class" type="submit" name="submit" value ="rap"></button>
            </form>

        </div>


<?
require_once "main/starter/footer.php";
?>
