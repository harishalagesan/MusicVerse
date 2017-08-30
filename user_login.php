<?php
$title="login";
require_once  "main/starter/page_start.php";
require_once "main/starter/functions.php";
require "main/classes/DB.class.php";

//Check to see if the user has logged out and display a message


//    Check for session existence
    if (isset($_SESSION) && $_SESSION['loggedIn']== true)
    {
       header("LOCATION:".URL_INDEX);
    }
    else{

        if($_GET["flag"] == true)
        {
            echo "<h5 class='teal-text' style='padding-left: 15em'>You have logged out, please login to continue shopping</h5>";
        }
    }

//    Check to see the login using credentials available in the database
if( isset( $_POST["login"] ) && (!isset( $errors ) )  ) {

    $db = DB::getInstance();
    //$salt = secure_generate_salt();
    $username = $_POST["username"];
    $password = $_POST["password"];
    //$hash = crypt($password, $salt);

    $query1 = "SELECT * from customer WHERE custEmail=? AND password=?";

    $input = array($username,$password);
    $data = array("s","s");
    $db->do_query($query1,$input,$data);
    $result = $db->get_affected_rows();


    if(!empty($username) && !empty($password)){
        if ($result == 1) {
            $_SESSION["loggedIn"] = true;
            $expire = time() + 60 * 10;
            $path = "/~ha2703/756/Project1/"; // path to homepage
            $domain = "kelvin.ist.rit.edu";
            $secure = false; // accessible on HTTP (not just HTTPS)
            $http_only = false; // accessible to js


            setcookie("loggedIn", $username, $expire, $path, $domain, $secure, $http_only);

//            Update the session table with user details
            $query2 = "INSERT INTO session(sessionID,username) VALUES (?,?)";
            $input2 = array(session_id(),$username);
            $data2 = array("s","s");
            $db->do_query($query2,$input2,$data2);
            if($db->get_error()){
                echo "Errors".$db->get_error();
            }

//            check for admin credentials
            else{
                if(($username == "shiva@pro1.com") AND ($password == "Shiva666rit")){

                    header("LOCATION:" . URL_ADMIN);
                }
                else {

                    header("LOCATION:" . URL_INDEX);
                }
            }

        } else {
            $errors[] = "THE USERNAME OR PASSWORD ARE INCORRECT!";
        }
    }

//    username validation
    if (empty($username)) {

        $errors[] = "PLEASE ENTER AN EMAIL ADDRESS<br/>";

    }
    else{

        $username = test_input($_POST["username"]);
        if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
            //yup its valid email
            $errors[] = "ONLY VALID EMAIL ID ENTRIES ALLOWED<br/>";
        }
    }

//    password validaton
    if (empty($password)) {

        $errors[] = "PLEASE ENTER A PASSWORD<br/>";

    }
    else{

        $password = test_input($_POST["password"]);

        // check if name only contains letters and whitespace
        if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/", $password)) {
            $errors[] = "MUST BE A MINIMUM OF 8 CHARACTERS
                             MUST CONTAIN AT LEAST 1 NUMBER
                             MUST CONTAIN AT LEAST ONE UPPERCASE CHARACTER
                             MUST CONTAIN AT LEAST ONE LOWERCASE CHARACTER";
        }
    }




    }
        if (isset($errors)) {

            foreach ($errors as $error) {

                echo "<p class= 'teal-text'>$error</p>";
            }


    }


require_once "main/starter/header.php";

?>


            <div class = "login_user">
                <div class="container white z-depth-2" >
                     <ul class="tabs teal">
                         <li class="tab col s3"><a class="white-text" style="padding-left: 22em; font-size: 20px">Login</a></li>
                     </ul>
                <div id="register" class="col s12">
                    <form class="col s12" name="input" action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST">
                         <div class="form-container" >
                             <h3 class="teal-text" style="padding-left: 10em">Hello</h3>
                                 <div class="row">
                                    <div class="input-field col s6">
                                        <input id="username" name ="username" type="email" placeholder="Provide registered email" value="<?php echo $uername;?>" >
                                        <label for="User_Name">Username</label>
                                    </div>
                                 </div>
                             <div class="row">
                                 <div class="input-field col s6">
                                        <input id="password" name ="password" type="password" placeholder="Provide registered password" value="<?php echo $login_password;?>" >
                                        <label for="Password">Password</label>
                                 </div>
                                 </div>
                                <center>
                                    <button class="btn waves-effect waves-light teal" type="submit" name="login">Login</button>
                                </center>
                         </div>
                    </form>
                </div>
                </div>
            </div>


<?
require_once "main/starter/footer.php";
?>