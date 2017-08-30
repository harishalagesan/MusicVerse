<?php


    class shipProduct
    {
        public static function build_shipcard($db_array){

            $new_item = $new_quant=$disc="";
            $sumPrice = $sumQuantity = $sumPrice1 = $sumQuantity1 = $sumPrice2 = $sumQuantity2=0;
            $display="";
            $display = "<div class='clear'></div>";
            $display .="<div id='shipitems'>";
            foreach ( $db_array as $record ) {


                $disc = $record['discount'];
                if ($disc != 0) {
                    $discounted = round((float)$record['prodPrice'] - ((float)$record['prodPrice'] * (int)$record['discount'] / 100), 2);

                } else {
                    $discounted = $record['prodPrice'];
                }
                $display .= "<div class='shipone_item'>";
                $display .= "<img class= 'shipaleft' src='" . $record['prodImage'] . "' alt='product image' />";
                $display .= "<p>" . $record['prodName'] . "</p>";
                $sumPrice1 = $discounted * (int)$record['quantity'];
                $display .= "<p>Price:" . $sumPrice1 . "$,  Quantity:" . $record['quantity'] . "</p>";
                $sumPrice = $sumPrice + $sumPrice1;
                $sumQuantity1 = $sumQuantity1 + $record['quantity'];
                $display .= "</div>";
            }
            $display .= "<p class='teal-text' style = 'padding-left:1em;'><strong>Total Price:" . ($sumPrice) . " $ and Total Products: " . ($sumQuantity1) . "</strong></p>";
            $display .= "</div>";
            $display .= "</div>";
            return $display;


        }
    }

?>