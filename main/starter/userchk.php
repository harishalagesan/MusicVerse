<?php
//require "../classes/DB.class.php";
//$db = DB::getInstance();
//$prodID = $custID = $quantity = $pid=$new_custID="";
//$validuser = "SELECT * FROM session WHERE sessionID=?";
//$input = array(session_id());
//$data = array("s");
//
//$db ->do_query($validuser,$input,$data);
//$result = $db->fetch_all_array();
//
//foreach ($result as $new){
//
//    $requested_result = $new[0]['sessionID'];
//
//}
//
////check for right user with session
//if((!isset($_SESSION["loggedIn"]) or $_SESSION["loggedIn"] == false) && empty($requested_result)){
//
//    header("LOCATION:" . URL_USERLOGIN);
//}
//
//$query3 = "SELECT * FROM session WHERE sessionID=?;";
//$db->do_query($query3,array(session_id()),array('s'));
//$result1 = $db->fetch_all_array();
//
//$new_user= $result1[0]['username'];
//
//$query5 = "SELECT * FROM customer WHERE custEmail=?;";
//$db->do_query($query5,array($new_user),array('s'));
//$result2 = $db->fetch_all_array();
//
//
//
//$new_custID = $result2[0]['custID'];
//
//?>