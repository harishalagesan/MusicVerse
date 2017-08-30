<?php
$title="Admin";

require_once  "main/starter/page_start.php";
require "main/classes/DB.class.php";
require "main/classes/editProduct.class.php";
require_once "main/starter/header.php";
require_once "main/starter/functions.php";
$db = DB::getInstance();
$prodName = $prodDesc = $prodPrice = $prodQty = $genre = "";
$discount= 0; $update_id="";

if((!isset($_SESSION["loggedIn"]) or $_SESSION["loggedIn"] == false)){

    header("LOCATION:" . URL_USERLOGIN);

}

//Admin login
$query3 = "SELECT * FROM session WHERE sessionID=?;";
$db->do_query($query3,array(session_id()),array('s'));
$result1 = $db->fetch_all_array();

$new_user= $result1[0]['username'];

if($new_user != "shiva@pro1.com"){

    header("LOCATION:" . URL_USERLOGIN);
}





//Admin check
if( (isset( $_POST["update"]) or (isset($_POST["update_existing"])) ) && (!isset( $errors ) )  ) {




    $prodName = $_POST["prodName"];
    $prodDesc = $_POST["prodDesc"];
    $prodPrice = $_POST["prodPrice"];
    $prodQty =$_POST["prodQty"];
    $genre = $_POST["genre"];
    $name_array = $_FILES['prodImage']['name'];
    $discount = $_POST["discount"];

    $dir = URL_IMG.$name_array;

    //Check product name validation
    if (empty($prodName)) {

        $errors[] = "PLEASE ENTER A PRODUCT NAME<br/>";

    }
    //Check product description validation
    if (empty($prodDesc)) {

        $errors[] = "PLEASE ENTER A DESCRPTION<br/>";

    }


    //check product price valdiation
    if (empty($prodPrice)) {

        $errors[] = "PLEASE ENTER A PRODUCT PRICE<br/>";

    } else {
        $prodPrice = test_input($_POST["prodPrice"]);
        if (!preg_match('/^\$?\d+(\.(\d{2}))?$/', $prodPrice)) {

            $errors[] = "PLEASE PROVIDE PRICE IN THE GIVEN FORMAT #.## or ##.## or ###.##<br/>";
        }

    }

    //For uploading image temporarily store in folder and then upload to server
    if(isset($_FILES['prodImage']))
    {
        $tmp_name_array = $_FILES['prodImage']['tmp_name'];
        $type_array = $_FILES['prodImage']['type'];
        $size_array = $_FILES['prodImage']['size'];
        $error_array = $_FILES['prodImage']['error'];

        for($i = 0; $i<count($tmp_name_array); $i++)
        {
            if(move_uploaded_file($tmp_name_array,PATH_IMG.$name_array))
            {
                echo $name_array[$i]."Upload is complete<br>";

            }  else {
                echo"Move_uploaded_file function failed for".$name_array[$i]."<br>";
            }
        }
    }

    //Product quantity check
    if (empty($prodQty)) {

        $errors[] = "PLEASE PROVIDE A PRODUCT QUANTITY<br/>";

    }

    else {
        $prodQty = test_input($_POST["prodQty"]);
        if (!preg_match("/^([1-9]|[1-9]\d|100)$/", $prodQty)) {

            $errors[] = "PLEASE PROVIDE QUANTITY AS A VALID WHOLE NUMBER<br/>";
        }

    }

    //Product Genre Check
    if (empty($genre)) {

        $errors[] = "PLEASE PROVIDE GENRE<br/>";

    }

    //Product discount check

    if (empty($discount)) {

        $discount = 0;

    }

    else {
        $discount = test_input($_POST["discount"]);
        if (!preg_match("/^(100|[0-9]{1,2})$/", $discount)) {

            $errors[] = "PLEASE PROVIDE DISCOUNT AS A VALID Percentage<br/>";
        }

        else {
            if(!empty($_POST['genre'])) {
                $gid = $_POST['genre'];
                $query6 = "SELECT discount from product WHERE discount > 0 AND genre =?;";
                $db->do_query($query6, array($gid), array("s"));
                $result = $db->get_affected_rows();
                echo $result;
                if ($result >= 5) {
                    $errors[] = "NUMBER OF DISCOUNTED ITEMS CANNOT EXCEED 5<br/>";
                }
            }
        }
    }



    //Adding and updating product table with new items
    if(!isset( $errors )){

        if(!$db->get_error()) {

            //Retreive name of product to check if already exists in database
            $queryname = "SELECT * FROM product WHERE prodName=?;";
            $db->do_query($queryname,array($prodName),array('s'));
            $resultname = $db->get_affected_rows();

            //Updating the existing data
            if((isset($_POST['update_existing'])) AND ($resultname != 0)) {

                $fid = $_POST['update_existing'];

                $query = "UPDATE product SET prodName =?,prodImage =?,prodDesc=?,prodPrice=?,prodQty=?,genre=?,discount=? Where prodID = $fid";
            }

            //Inserting new data
            else if((isset($_POST['update'])) AND ($resultname == 0)) {

                $query = "INSERT INTO product(prodName,prodImage,prodDesc,prodPrice,prodQty,genre,discount) VALUES (?,?,?,?,?,?,?)";

            }
            else{

                echo "<p class= 'teal-text' style = 'padding-left: 30em'>CANNOT ADD/UPDATE TO THE DATABASE!!!</p><br/>";
            }

            $input = array($prodName, $dir, $prodDesc, $prodPrice, $prodQty, $genre, $discount);
            $data = array("s", "s", "s", "i", "i", "s", "i");
            $db->do_query($query, $input, $data);
            if (!$db->get_error()) {
                echo "<p class= 'teal-text' style = 'padding-left: 30em'>PRODUCT ADDED SUCCESSFULLY!!!</p><br/>";
            } else {
                echo "<p class= 'teal-text' style = 'padding-left: 30em'>CANNOT ADD TO THE DATABASE!!!</p><br/>";


            }


        }
    }

}

if ( isset( $errors ) ) {

    foreach ( $errors as $error ){

        echo "<p class= 'teal-text'>$error</p>";
    }
}


$query = "SELECT DISTINCT genre
FROM product";



$db->do_query( $query, array(), array() );


echo editProduct::build_selection($db->fetch_all_array(),"genre","genre-submit");
if(!empty($_POST['genre'])){
    $gid = $_POST['genre'];
    $q = "SELECT prodName FROM product WHERE genre=?;";
    $db->do_query($q,array($gid),array("s"));
    echo editProduct::build_selection($db->fetch_all_array(),"product","product-submit");
}
$prodID ="";
if(!empty($_POST['product'])){
    $prodName = $_POST['product'];
    $q = "SELECT * FROM product WHERE prodName=?;";
    $db->do_query($q,array($prodName),array('s'));
    $result = $db->fetch_all_array();


    $prodID = $result[0]['prodID'];
    $prodName = $result[0]['prodName'];
    $prodDesc = $result[0]['prodDesc'];
    $prodPrice=$result[0]['prodPrice'];
    $prodQty=$result[0]['prodQty'];
    $genre=$result[0]['genre'];
    $discount=$result[0]['discount'];
    $update_id = "1";
}

?>


<div class = "register_user">
    <div class="container white z-depth-2" >
        <ul class="tabs teal">
            <li class="tab col s3"><a class="white-text" style="padding-left: 22em; font-size: 20px">Admin Services</a></li>
        </ul>
        <div id="register" class="col s12">
            <form class="col s12" name="input" action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST" enctype="multipart/form-data">
                <div class="form-container" >
                    <h3 class="teal-text" style="padding-left: 10em">Hi Admin</h3>
                    <div class="row">
                        <div class="input-field col s6">
                            <input id="prodName" name ="prodName" type="text" value="<?php echo $prodName?$prodName:'';?>" >
                            <label for="Product_Name">Product Name</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="prodPrice" name = "prodPrice" type="text" placeholder="Provide in ##.## format" value="<?php echo $prodPrice?$prodPrice:'';?>">
                            <label for="Product_Price">Product Price</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="prodDesc" name = "prodDesc" type="text" value="<?php echo $prodDesc?$prodDesc:'';?>" >
                            <label for="Product_Description">Product Description</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input id="prodQty" name="prodQty" type="text" value="<?php echo $prodQty?$prodQty:'';?>">
                            <label for="Product Quantity">Product Quantity</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="discount" name="discount" type="text" value="<?php echo $discount?$discount:'';?>">
                            <label for="Discount">Discount (%)</label>
                        </div>
                    </div>


                    <label for ="genre">Select Genre</label>
                    <select class="browser-default" name = "genre">
                        <option value="" selected>Choose your option</option>
                        <option value="rock" <?=($genre=="rock")?"selected":'';?>>Rock</option>
                        <option value="jazz" <?=$genre=="jazz"?"selected":'';?>>Jazz</option>
                        <option value="pop"<?=$genre=="pop"?"selected":'';?>>Pop</option>
                        <option value="hiphop"<?=$genre=="hiphop"?"selected":'';?>>HipHop</option>
                        <option value="rap"<?=$genre=="rap"?"selected":'';?>>Rap</option>
                        <option value="blues"<?=$genre=="blues"?"selected":'';?>>Blues</option>
                        <option value="death-metal"<?=$genre=="death-metal"?"selected":'';?>>Death-Metal</option>
                        <option value="trance"<?=$genre=="trance"?"selected":'';?>>Trance</option>
                    </select>


                    <div class="file-field input-field">
                        <div class="btn">
                            <span>Choose a file</span>
                            <input type="file" name ="prodImage">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text">
                        </div>
                    </div>

                    <center>
                        <button class="btn waves-effect waves-light teal" type="submit" name="update">Add new product</button> <button class="btn waves-effect waves-light teal" type="submit" name="update_existing" value=<?php echo $prodID ;?>>Update product</button> <button class="btn waves-effect waves-light teal" type="reset" name="reset" value ="Reset Form">Reset</button>
                    </center>
                </div>
            </form>
        </div>
    </div>
</div>





<?
require_once "main/starter/footer.php";
?>
