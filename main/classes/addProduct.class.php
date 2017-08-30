
<?php

//This class adds products to product page, discount page and cart
class addProduct
{

    public static function build_card($db_array,$bool){

        $new_item = $new_quant=$disc="";
        $sumPrice = $sumQuantity = $sumPrice1 = $sumQuantity1 = $sumPrice2 = $sumQuantity2=0;
        $display="";
        $cur_page= explode("/", $_SERVER['SCRIPT_NAME']);
        if ($cur_page[4] == "cart.php")
        {
            $display = "<div class='clear'></div>";
            $display .= "<h2 class='teal-text'>Cart Items</h2>";
            $display .="<div id='items'>";
            foreach ( $db_array as $record ) {


                $disc = $record['discount'];
                if($disc !=0) {
                    $discounted = round((float)$record['prodPrice'] - ((float)$record['prodPrice']*(int)$record['discount']/100),2);

                }
                else{
                    $discounted = $record['prodPrice'];
                }
                $display .= "<div class='one_item'>";

                $display .= "<h4>" . $record['prodName'] . "</h4>";
                $display .= "<p>" . $record['prodDesc'] . "</p>";

                $sumPrice1 = $discounted * (int)$record['quantity'];

                $display .= "<p><strong>Price:</strong>" . $sumPrice1 . "<strong>$</strong></p>";
                $sumPrice = $sumPrice + $sumPrice1;
                $display .= "<p><strong>" . $record['quantity'] . "</strong></p>";
                $sumQuantity1 = $sumQuantity1 + $record['quantity'];
                $display .= "<div><form method='POST' action = '" . ($_SERVER['PHP_SELF']) . "'><input type='hidden' name='item_removed' value=" . $record['prodID'] . " /><input type='submit' name='remove' value='Delete' /></form></div>";
                $display .= "</div>";
            }
            $display .= "</div>";
            $display .= "<p class='teal-text' style = 'padding-left:35em;'><strong>Total Price:" . ($sumPrice) . " $ and Total Products: " . ($sumQuantity1) . "</strong></p>";

            if ($sumQuantity1 == 0) {
                $display .= "<p class= 'teal-text' style = 'padding-left:35em;'><strong>The Cart is empty</strong></p>";
            }
            if(isset($_POST['checkout']) && ($sumQuantity1 == 0)){

                $display .= "<p class= 'teal-text' style = 'padding-left:35em;'><strong>Please add items to cart before checkout</strong></p>";
            }

            if(isset($_POST['checkout']) && ($sumQuantity1 > 0)){

                header("LOCATION:" . URL_CHECKOUT);
            }

            $display .= "</div>";
            //Display delete all and checkout buttons and submit
            $display .= "<div id = 'checkout'><form method='POST' action = '" . ($_SERVER['PHP_SELF']) . "'><input type='hidden' name='checkout' value=" . $new_custID . " /><input type='submit' name='checkout' value='Checkout' style = 'float:right' /></form></div>";
            $display .= "<div><form method='POST' action = '" . ($_SERVER['PHP_SELF']) . "'><input type='hidden' name='all_removed' value=" . $new_custID . " /><input type='submit' name='all_removed' value='Delete All' /></form></div>";
            return $display;
        }

        if ($cur_page[4] != "cart.php")
        {
            if($bool==true) {
                $display = "<div class='clear'></div>";
                $display .= "<h2 class='teal-text'>Sale</h2>";
                $display .= "<div id='items'>";
                foreach ($db_array as $record) {

                    $disc = $record['discount'];

                    $discounted = round((float)$record['prodPrice'] - ((float)$record['prodPrice'] * (int)$record['discount'] / 100), 2);
                    if ($disc != 0) {
                        $display .= "<div class='one_item'  id = 'sale' >";
                        $display .= "<h4>" . $record['prodName'] . "</h4>";
                        $display .= "<img class= 'aleft' src='" . $record['prodImage'] . "' alt='product image' />";
                        $display .= "<p>" . $record['prodDesc'] . "</p>";
                        $display .= "<p><strong>Original Price:</strong><del>" . $record['prodPrice'] . "</del><strong>  Discounted Price:</strong>" . $discounted . " $</p>";
                        $display .= "<p><strong>" . $record['prodQty'] . "</strong> left!</p>";
                        $display .= "<div><form method='POST'><input type='hidden' name='item_added' value=" . $record['prodID'] . " /><input type='submit' name='add' value='Add To Cart' /></form></div>";
                        $display .= "</div>";
                    }

                }
                $display .= "</div>";
            }else{
                $display .= "<div class='clear'></div>";
                $display .= "<h2 class='teal-text'>Catalog</h2>";
                $display .="<div id='items'>";
                $cur_page= explode("/", $_SERVER['SCRIPT_NAME']);
                foreach ( $db_array as $record ) {

                    $disc = $record['discount'];

                    if($disc ==0) {
                        $display .= "<div class='one_item' id='catalog'>";
                        $display .= "<h4>" . $record['prodName'] . "</h4>";
                        $display .= "<img class= 'aleft' src='" . $record['prodImage'] . "' alt='product image' />";
                        $display .= "<p>" . $record['prodDesc'] . "</p>";
                        $display .= "<p><strong>Price:</strong>" . $record['prodPrice'] . "</p>";
                        $display .= "<p><strong>" . $record['prodQty'] . "</strong> left!</p>";
                        $display .= "<div><form method='POST'><input type='hidden' name='item_added' value=" . $record['prodID'] . " /><input type='submit' name='add' value='Add To Cart' /></form></div>";
                        $display .= "</div>";

                    }

                }
                $display .="</div>";
            }
            return $display;

        }

    }
}

?>


