<?php
$title="Products";
require_once "main/starter/page_start.php";
require_once "main/starter/functions.php";
require "main/classes/DB.class.php";
require "main/classes/addProduct.class.php";


$db = DB::getInstance();
$prodID = $custID = $quantity = $pid=$new_custID="";


require_once "main/starter/header.php";
if((!isset($_SESSION["loggedIn"]) or $_SESSION["loggedIn"] == false) && empty($requested_result)){

    header("LOCATION:" . URL_USERLOGIN);
}

//check if item is added to cart
if(isset($_POST['item_added'])){


    //update product table
    $pid = $_POST['item_added'];
    $query2 = "UPDATE product SET prodQTY = prodQTY-1 WHERE prodID=?;";
    $db->do_query($query2,array($pid),array('i'));


    //Find user based on session
    $query3 = "SELECT * FROM session WHERE sessionID=?;";
    $db->do_query($query3,array(session_id()),array('s'));
    $result1 = $db->fetch_all_array();
    $new_user= $result1[0]['username'];



    $query4 = "SELECT * FROM customer WHERE custEmail=?;";
    $db->do_query($query4,array($new_user),array('s'));
    $result2 = $db->fetch_all_array();
    $new_custID = $result2[0]['custID'];


    //Update cart table
    $query1 = "INSERT INTO cart(custID,prodID,quantity) VALUES (?,?,?) on DUPLICATE KEY UPDATE quantity=quantity+1";
    $input1 = array($new_custID, $pid, 1);
    $data1 = array("i", "i", "i");
    $db->do_query($query1, $input1, $data1);



}

//Display all products

//Pagination
$pageno ='';
if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
} else {
    header("Location:".URL_PRODUCT."?page=".$_GET['page']."&pageno=1");
}

$qrows = "SELECT discount FROM product WHERE discount = 0 and genre =?;";
$result = $db->do_query( $qrows, array($_GET['page']), array('s') );
$numrows = $db->get_affected_rows();
$rows_per_page = 5;
$lastpage = ceil($numrows/$rows_per_page);


$pageno = (int)$pageno;
if ($pageno > $lastpage) {
    $pageno = $lastpage;
} // if
if ($pageno < 1) {
    $pageno = 1;
}

$limit = ($pageno - 1) * $rows_per_page;

//build discount cards
$query= "SELECT *
FROM product where genre = ? AND discount>0
ORDER BY prodID";

$db->do_query( $query, array($_GET['page']), array('s'));
echo addProduct::build_card( $db->fetch_all_array(),true);

//build catalog cards
$query= "SELECT *
FROM product where genre = ? AND discount=0
ORDER BY prodID LIMIT ?,?";
$db->do_query( $query, array($_GET['page'],$limit,$rows_per_page), array('s',"i","i") );
echo addProduct::build_card( $db->fetch_all_array(),false);

//pagination display
echo "<div class= 'teal-text' style = 'padding-left: 35em; font-weight: bold'>";
if ($pageno == 1) {
    echo"FIRST PREV";
} else {
    echo "<a class= href='".(URL_PRODUCT)."?page=".($_GET['page'])."&pageno=1'>FIRST</a>";
//    echo "<a href='".($_SERVER ['PHP_SELF'])."?page=".($_GET['page'])."&pageno=".($_GET ['pageno'])."'> FIRST </a> ";
    $prevpage = $pageno-1;
    echo "<a href='".(URL_PRODUCT)."?page=".($_GET['page'])."&pageno=".($prevpage)."'> PREV </a> ";
}
echo " ( Page $pageno of $lastpage ) ";

if ($pageno == $lastpage) {
    echo " NEXT LAST ";
} else {
    $nextpage = $pageno+1;
    echo " <a href='".(URL_PRODUCT)."?page=".($_GET['page'])."&pageno=".($nextpage)."'>NEXT</a> ";
    echo " <a href='".(URL_PRODUCT)."?page=".($_GET['page'])."&pageno=".($lastpage)."'>LAST</a> ";
}
echo "</div>";
?>

<?
require_once "main/starter/footer.php";
?>
