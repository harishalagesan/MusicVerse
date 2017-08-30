<?php
$title="Register";

require_once  "main/starter/page_start.php";
require "main/classes/DB.class.php";
require_once "main/starter/header.php";
require_once "main/starter/functions.php";

//    Check for session existence
if (isset($_SESSION) && $_SESSION['loggedIn']== true)
{
    header("LOCATION:".URL_INDEX);
}


//Register new user
    if( isset( $_POST["register"] ) && (!isset( $errors ) )  ) {

        //$salt = secure_generate_salt();

        $db = DB::getInstance();
        $fname = $_POST["fName"];
        $lname = $_POST["lName"];
        $email = $_POST["eMail"];
        $email_confirm =$_POST["email_confirm"];
        $password = $_POST["password"];
        //$hash = crypt($password, $salt);
        $password_confirm = $_POST["password_confirm"];
        $flag = "user";


//        first name validation
        if (empty($fname)) {

            $errors[] = "PLEASE ENTER A FIRST NAME<br/>";

        } else {
            $fname = test_input($_POST["fName"]);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z ]*$/", $fname)) {
                $errors[] = "ONLY LETTERS AND WHITE SPACE ALLOWED<br/>";
            }
        }
//        last name validation
        if (empty($lname)) {

            $errors[] = "PLEASE ENTER A LAST NAME<br/>";

        } else {
            $lname = test_input($_POST["lName"]);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z ]*$/", $lname)) {
                $errors[] = "ONLY LETTERS AND WHITE SPACE ALLOWED<br/>";
            }
        }
//        email validation
        if (empty($email) or empty($email_confirm)) {

            $errors[] = "PLEASE ENTER AN EMAIL ADDRESS<br/>";

        } else {
            $email = test_input($_POST["eMail"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                //yup its valid email
                $errors[] = "ONLY VALID EMAIL ID ENTRIES ALLOWED<br/>";
            }
        }

//        email confirmation validation
        if (!empty($email_confirm) && ($email_confirm != $email)) {

            $errors[] = "THE EMAIL ADDRESSES DO NOT MATCH<br/>";

        }

//        password validation
        if (empty($password) or empty($password_confirm)) {

            $errors[] = "PLEASE ENTER A PASSWORD<br/>";

        } else {
            $password = test_input($_POST["password"]);

            // check if name only contains letters and whitespace
            if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/", $password)) {
                $errors[] = "MUST BE A MINIMUM OF 8 CHARACTERS
                             MUST CONTAIN AT LEAST 1 NUMBER
                             MUST CONTAIN AT LEAST ONE UPPERCASE CHARACTER
                             MUST CONTAIN AT LEAST ONE LOWERCASE CHARACTER";
            }

        }


//            password confirmation check
            if (!empty($password_confirm) && ($password_confirm != $password)) {

                $errors[] = "THE PASSWORDS DO NOT MATCH<br/>";

            }

//            update customer table
        if( !isset( $errors ) ) {
            if(!$db->get_error()) {

                $query = "INSERT INTO customer(custFN,custLN,custEmail,password,flag) VALUES (?,?,?,?,?)";
                $input = array($fname, $lname, $email, $password, $flag);
                $data = array("s", "s", "s", "s", "s");
                $db->do_query($query, $input, $data);
                if (!$db->get_error()) {
                    header("Location:" . URL_USERLOGIN);
                } else {
                    echo "CANNOT UPDATE THE DATABASE!!!<br/>";
                }

            }
        }

    }

if ( isset( $errors ) ) {

    foreach ( $errors as $error ){

        echo "<p class= 'teal-text'>$error</p>";
    }
}



?>

<div class = "register_user">
    <div class="container white z-depth-2" >
        <ul class="tabs teal">
            <li class="tab col s3"><a class="white-text" style="padding-left: 22em; font-size: 20px">User Registration</a></li>
        </ul>
        <div id="register" class="col s12">
            <form class="col s12" name="input" action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST">
                <div class="form-container" >
                    <h3 class="teal-text" style="padding-left: 10em">Welcome</h3>
                    <div class="row">
                        <div class="input-field col s6">
                            <input id="fName" name ="fName" type="text" value="<?php echo $fname;?>" >
                            <label for="first_name">First Name</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="lName" name ="lName" type="text" value="<?php echo $lname;?>" >
                            <label for="last_name">Last Name</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="eMail" name = "eMail" type="email" value="<?php echo $email;?>">
                            <label for="email1">Email</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="email_confirm" name="email_confirm" type="email" value="<?php echo $email_confirm;?>">
                            <label for="email_confirm">Email Confirmation</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="password" name="password" type="password" value="<?php echo $password;?>" >
                            <label for="password">Password</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="password_confirm" name ="password_confirm"type="password" value="<?php echo $password_confirm;?>" >
                            <label for="password_confirm">Password Confirmation</label>
                        </div>
                    </div>
                    <center>
                        <button class="btn waves-effect waves-light teal" type="submit" name="register">Register</button>
                    </center>
                </div>
            </form>
        </div>
    </div>
</div>





<?
require_once "main/starter/footer.php";
?>
