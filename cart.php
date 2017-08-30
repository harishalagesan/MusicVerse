<?php
$title="Cart";

require_once "main/starter/page_start.php";
require_once "main/starter/functions.php";
require "main/classes/DB.class.php";
require "main/classes/addProduct.class.php";



$db = DB::getInstance();
$prodID = $custID = $quantity = $pid=$new_custID="";

require_once "main/starter/header.php";

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

//update item removed from cart in both cart and product table
if(isset($_POST['item_removed'])){


    $pid = $_POST['item_removed'];
    $query1 = "UPDATE cart SET quantity = quantity-1 WHERE prodID=?;";
    $db->do_query($query1,array($pid),array('i'));

    $query4 = "UPDATE product SET prodQty = prodQty+1 WHERE prodID=?;";
    $db->do_query($query4,array($pid),array('i'));
}


$query3 = "SELECT * FROM session WHERE sessionID=?;";
$db->do_query($query3,array(session_id()),array('s'));
$result1 = $db->fetch_all_array();

$new_user= $result1[0]['username'];

$query4 = "SELECT * FROM customer WHERE custEmail=?;";
$db->do_query($query4,array($new_user),array('s'));
$result2 = $db->fetch_all_array();



$new_custID = $result2[0]['custID'];

//display all items in cart for the customer who is logged in
$query = "SELECT p.prodID, p.prodName, p.prodDesc, p.prodPrice, c.quantity, p.genre, p.discount 
                    FROM
                    product p 
                    INNER JOIN
                    cart c ON c.prodID = p.prodID WHERE custID = $new_custID";


$db->do_query( $query, array(), array() );

echo addProduct::build_card( $db->fetch_all_array(),false);
?>

<?
require_once "main/starter/footer.php";
?>
