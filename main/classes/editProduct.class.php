<?php

//Dynamic select statements with admin options to edit the products
class editProduct
{
    public static function build_selection($db_array,$name,$value)
    {
        $display = "<div class = 'register_user'>
                    <div class='container white z-depth-2' >
                        <ul class='tabs teal'>
                            <li class='tab col s3'><a class='white-text' style='padding-left: 22em; font-size: 20px'>Admin Services</a></li>
                        </ul>";


        $display .="<form method='POST' target='_self' ><label for ='genre'>Select ".ucfirst($name)."</label>";
        $display .= "<select class='browser-default' name = '$name'>";
        $display .= "<option value='' disabled selected>Choose your option</option>";

        foreach($db_array as $record) {
            foreach($record as $field)
                $display .= "<option value='$field'>$field</option>";
        }
        $display .="</select>";
        $display .="<button type='submit' name='$value'>Select ".ucfirst($name)."</button></form>";

        $display .="</div>
                        </div>";
        return $display;

    }
}


?>