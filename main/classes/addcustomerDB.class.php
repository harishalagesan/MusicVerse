<?php
class addcustomerDB
{

    private $mysqli;

    //Database connection establish
    function __construct()
    {

        require "/home/ha2703/db_conn.php";

        // 1) open a DB connection

        $this->mysqli = new mysqli($mysqli_host, $mysqli_user, $mysqli_pass, $mysqli_name);

        //2) Check the connection

        if ($this->mysqli->connect_error) {

            echo "connect failed : " . $this->mysqli->connect_error;
            exit();
        }
    }


    //Add customers
    function insertcustomers( $pid, $phtype, $phnum, $arc){


        $query = "INSERT INTO phonenumbers (PersonID, PhoneTypeID, PhoneNum, AreaCode) VALUES (?, ?, ?, ?)";

        if( $stmt = $this->mysqli->prepare( $query )){

            $stmt -> bind_param( "iiss" , $pid, $phtype, $phnum, $arc);
            $stmt -> execute();                                     // prevents sql injection also
            $stmt->store_result();
            $num_rows = $stmt-> affected_rows;
            $insert_id = $stmt -> insert_id;
        }

        return $insert_id;

    }


    function updatephonenumbers( $fields ) {
        $query = "UPDATE phonenumbers SET ";
        $insert_id = 0;
        $num_rows = 0;

        foreach( $fields as $key => $val){

            switch ( $key ){
                case "pid":
                    $query .= "PersonID='$val', ";
                    break;

                case "first":
                    $query .= "PhoneTypeID='$val', ";
                    break;

                case "last":
                    $query .= "PhoneNum='$val', ";
                    break;

                case "arc":
                    $query .= "AreaCode='$val', ";
                    break;

                case "id":
                    $insert_id = intval( $val);
                    break;
            }
        }

        $query = trim ( $query, ", ");
        $query .= " Where PersonID = ?";

        if( $stmt = $this->mysqli->prepare( $query )){

            $stmt -> bind_param( "i" , $insert_id);
            $stmt -> execute();                                     // prevents sql injection also
            $stmt->store_result();
            $num_rows = $stmt-> affected_rows;
            $insert_id = $stmt -> insert_id;
        }
        return $num_rows;
    }


}
?>