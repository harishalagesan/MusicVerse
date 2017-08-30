<?php

class FN {

    public static function build_table($db_array,$link,$tabf) {
        $display = "<table border='1' class = 'table'>\n<tr>\n";
        foreach ( $db_array[0] as $column => $field ) {
            $display .= "<th>$column</th>\n";
        }
        $display .= "</tr>\n";
        if($tabf == "true" ){
            foreach ( $db_array as $record ) {
                $display .= "<tr>\n";
                $oldValue ='';
                foreach ( $record as $id => $field ) {
                    $oldValue .= $field.",";
                    if($id == "PersonID"){
                        $display .= "<td><a href='$link?PersonID=$field'>$field</a></td>\n";
                    }
                    if($id == "AreaCode"){
                        $display .= "<td><input type= 'text' name=$field value='$field'></td>";
                    }
                    if($id == "PhoneNum"){
                        $display .= "<td><input type= 'text' name=$field value='$field'></td>";
                    }
                    if($id == "PhoneTypeID"){
                        $display .= "<td><select name=$field>
                                    <option value='2' ".($field == 2 ? "selected" :'')." >Home</option>  
                                    <option value='3' ".($field == 3 ? "selected" :'').">Work</option> 
                                    <option value='1' ".($field == 1 ? "selected" :'')." >Cell</option>
                                    <option value='4' ".($field == 4 ? "selected" :'').">Other</option>
                                    </select></td>";
                    }

                }
                $display .="<td><input type='radio' value=$oldValue name ='rad'></td>";
                $display .= "</tr>\n";
            }
        }
        else {
            foreach ($db_array as $record) {
                $display .= "<tr>\n";
                foreach ($record as $id => $field) {
                    if ($id == "PersonID") {
                        $display .= "<td><a href='$link?PersonID=$field'>$field</a></td>\n";
                    } else {
                        $display .= "<td>$field</td>\n";
                    }
                }
                $display .= "</tr>\n";
            }
        }
        $display .= "</table>\n";

        return $display;
    }

}

?>