<?php
$title="Checkout";
require_once  "main/starter/page_start.php";
require "main/classes/DB.class.php";
require_once "main/starter/header.php";

require_once "main/starter/functions.php";
//require_once "main/starter/userchk.php";
require "main/classes/shipProduct.php";

$sesid = session_id();
$db = DB::getInstance();

if(isset($_POST["ship"])) {
    $sfullname = $_POST["fullName"];
    $saddr1 = $_POST["addr1"];
    $saddr2 = $_POST["addr2"];
    $scity = $_POST["city"];
    $sspr = $_POST["spr"];
    $szip = $_POST["zip"];
    $scountry = $_POST["country"];
    $sphno = $_POST["phno"];


    $query = "INSERT INTO Shipping(sessionID,fullName,adl1,adl2,city,state,zip,country,phNo) VALUES (?,?,?,?,?,?,?,?,?)";
    $input = array(session_id(),$sfullname, $saddr1, $saddr2, $scity, $sspr, $szip, $scountry,$sphno);
    $data = array("s","s", "s", "s", "s", "s", "s", "s", "s");
    $db->do_query($query, $input, $data);

}

if(isset($_POST["pay"])) {

    $crdnum = $_POST["cardnumber"];
    $fnamecrd = $_POST["fullNamecrd"];
    $expd = $_POST["expdate"];


    $query1 = "UPDATE  Shipping SET cardNum =?,nameCard=?,expDate =? WHERE sessionID = '$sesid'";
    $input1 = array($crdnum, $fnamecrd, $expd);
    $data1 = array("s", "s", "d");
    $db->do_query($query1, $input1, $data1);
}

?>

<ul class="collapsible popout" data-collapsible="accordion">
    <li>
        <div class="collapsible-header">Choose a shipping address</div>
        <div class="collapsible-body">
            <div class = "shipping_address">
                <div class="container white z-depth-2" >
                    <div id="shipping" class="col s12">
                        <form class="col s12" name="input" action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST">
                            <div class="form-container" >
                                <h4 class="teal-text" style="padding-left: 8em">Enter a shipping address</h4>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="fullName" name ="fullName" type="text" value="<?php echo $fullname;?>" >
                                        <label for="fullName">Full Name :</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="addr1" name ="addr1" type="text" value="<?php echo $addr1;?>" >
                                        <label for="addr1">Address line 1 :</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="addr2" name ="addr2" type="text" value="<?php echo $addr2;?>" >
                                        <label for="addr2">Address line 2 :</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="city" name ="city" type="text" value="<?php echo $city;?>" >
                                        <label for="city">City :</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="spr" name="spr" type="text" value="<?php echo $spr;?>">
                                        <label for="spr">State/Province/Region :</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="zip" name="zip" type="text" value="<?php echo $zip;?>">
                                        <label for="zip">Zip :</label>
                                    </div>
                                </div>
                                <div class="row">
                                <div class="input-field col s12">
                                    <select id="country" name ="country">
                                        <option value="AF">Afghanistan</option>
                                        <option value="AX">Aland Islands</option>
                                        <option value="AL">Albania</option>
                                        <option value="DZ">Algeria</option>
                                        <option value="AS">American Samoa</option>
                                        <option value="AD">Andorra</option>
                                        <option value="AO">Angola</option>
                                        <option value="AI">Anguilla</option>
                                        <option value="AQ">Antarctica</option>
                                        <option value="AG">Antigua and Barbuda</option>
                                        <option value="AR">Argentina</option>
                                        <option value="AM">Armenia</option>
                                        <option value="AW">Aruba</option>
                                        <option value="AU">Australia</option>
                                        <option value="AT">Austria</option>
                                        <option value="AZ">Azerbaijan</option>
                                        <option value="BS">Bahamas, The</option>
                                        <option value="BH">Bahrain</option>
                                        <option value="BD">Bangladesh</option>
                                        <option value="BB">Barbados</option>
                                        <option value="BY">Belarus</option>
                                        <option value="BE">Belgium</option>
                                        <option value="BZ">Belize</option>
                                        <option value="BJ">Benin</option>
                                        <option value="BM">Bermuda</option>
                                        <option value="BT">Bhutan</option>
                                        <option value="BO">Bolivia</option>
                                        <option value="BQ">Bonaire, Saint Eustatius and Saba</option>
                                        <option value="BA">Bosnia and Herzegovina</option>
                                        <option value="BW">Botswana</option>
                                        <option value="BV">Bouvet Island</option>
                                        <option value="BR">Brazil</option>
                                        <option value="IO">British Indian Ocean Territory</option>
                                        <option value="BN">Brunei Darussalam</option>
                                        <option value="BG">Bulgaria</option>
                                        <option value="BF">Burkina Faso</option>
                                        <option value="BI">Burundi</option>
                                        <option value="KH">Cambodia</option>
                                        <option value="CM">Cameroon</option>
                                        <option value="CA">Canada</option>
                                        <option value="CV">Cape Verde</option>
                                        <option value="KY">Cayman Islands</option>
                                        <option value="CF">Central African Republic</option>
                                        <option value="TD">Chad</option>
                                        <option value="CL">Chile</option>
                                        <option value="CN">China</option>
                                        <option value="CX">Christmas Island</option>
                                        <option value="CC">Cocos (Keeling) Islands</option>
                                        <option value="CO">Colombia</option>
                                        <option value="KM">Comoros</option>
                                        <option value="CG">Congo</option>
                                        <option value="CD">Congo, The Democratic Republic of the</option>
                                        <option value="CK">Cook Islands</option>
                                        <option value="CR">Costa Rica</option>
                                        <option value="CI">Cote D'ivoire</option>
                                        <option value="HR">Croatia</option>
                                        <option value="CW">Curaçao</option>
                                        <option value="CY">Cyprus</option>
                                        <option value="CZ">Czech Republic</option>
                                        <option value="DK">Denmark</option>
                                        <option value="DJ">Djibouti</option>
                                        <option value="DM">Dominica</option>
                                        <option value="DO">Dominican Republic</option>
                                        <option value="EC">Ecuador</option>
                                        <option value="EG">Egypt</option>
                                        <option value="SV">El Salvador</option>
                                        <option value="GQ">Equatorial Guinea</option>
                                        <option value="ER">Eritrea</option>
                                        <option value="EE">Estonia</option>
                                        <option value="ET">Ethiopia</option>
                                        <option value="FK">Falkland Islands (Malvinas)</option>
                                        <option value="FO">Faroe Islands</option>
                                        <option value="FJ">Fiji</option>
                                        <option value="FI">Finland</option>
                                        <option value="FR">France</option>
                                        <option value="GF">French Guiana</option>
                                        <option value="PF">French Polynesia</option>
                                        <option value="TF">French Southern Territories</option>
                                        <option value="GA">Gabon</option>
                                        <option value="GM">Gambia, The</option>
                                        <option value="GE">Georgia</option>
                                        <option value="DE">Germany</option>
                                        <option value="GH">Ghana</option>
                                        <option value="GI">Gibraltar</option>
                                        <option value="GR">Greece</option>
                                        <option value="GL">Greenland</option>
                                        <option value="GD">Grenada</option>
                                        <option value="GP">Guadeloupe</option>
                                        <option value="GU">Guam</option>
                                        <option value="GT">Guatemala</option>
                                        <option value="GG">Guernsey</option>
                                        <option value="GN">Guinea</option>
                                        <option value="GW">Guinea-Bissau</option>
                                        <option value="GY">Guyana</option>
                                        <option value="HT">Haiti</option>
                                        <option value="HM">Heard Island and the McDonald Islands</option>
                                        <option value="VA">Holy See</option>
                                        <option value="HN">Honduras</option>
                                        <option value="HK">Hong Kong</option>
                                        <option value="HU">Hungary</option>
                                        <option value="IS">Iceland</option>
                                        <option value="IN">India</option>
                                        <option value="ID">Indonesia</option>
                                        <option value="IQ">Iraq</option>
                                        <option value="IE">Ireland</option>
                                        <option value="IM">Isle of Man</option>
                                        <option value="IL">Israel</option>
                                        <option value="IT">Italy</option>
                                        <option value="JM">Jamaica</option>
                                        <option value="JP">Japan</option>
                                        <option value="JE">Jersey</option>
                                        <option value="JO">Jordan</option>
                                        <option value="KZ">Kazakhstan</option>
                                        <option value="KE">Kenya</option>
                                        <option value="KI">Kiribati</option>
                                        <option value="KR">Korea, Republic of</option>
                                        <option value="XK">Kosovo</option>
                                        <option value="KW">Kuwait</option>
                                        <option value="KG">Kyrgyzstan</option>
                                        <option value="LA">Lao People's Democratic Republic</option>
                                        <option value="LV">Latvia</option>
                                        <option value="LB">Lebanon</option>
                                        <option value="LS">Lesotho</option>
                                        <option value="LR">Liberia</option>
                                        <option value="LY">Libya</option>
                                        <option value="LI">Liechtenstein</option>
                                        <option value="LT">Lithuania</option>
                                        <option value="LU">Luxembourg</option>
                                        <option value="MO">Macao</option>
                                        <option value="MK">Macedonia, The Former Yugoslav Republic of</option>
                                        <option value="MG">Madagascar</option>
                                        <option value="MW">Malawi</option>
                                        <option value="MY">Malaysia</option>
                                        <option value="MV">Maldives</option>
                                        <option value="ML">Mali</option>
                                        <option value="MT">Malta</option>
                                        <option value="MH">Marshall Islands</option>
                                        <option value="MQ">Martinique</option>
                                        <option value="MR">Mauritania</option>
                                        <option value="MU">Mauritius</option>
                                        <option value="YT">Mayotte</option>
                                        <option value="MX">Mexico</option>
                                        <option value="FM">Micronesia, Federated States of</option>
                                        <option value="MD">Moldova, Republic of</option>
                                        <option value="MC">Monaco</option>
                                        <option value="MN">Mongolia</option>
                                        <option value="ME">Montenegro</option>
                                        <option value="MS">Montserrat</option>
                                        <option value="MA">Morocco</option>
                                        <option value="MZ">Mozambique</option>
                                        <option value="MM">Myanmar</option>
                                        <option value="NA">Namibia</option>
                                        <option value="NR">Nauru</option>
                                        <option value="NP">Nepal</option>
                                        <option value="NL">Netherlands</option>
                                        <option value="AN">Netherlands Antilles</option>
                                        <option value="NC">New Caledonia</option>
                                        <option value="NZ">New Zealand</option>
                                        <option value="NI">Nicaragua</option>
                                        <option value="NE">Niger</option>
                                        <option value="NG">Nigeria</option>
                                        <option value="NU">Niue</option>
                                        <option value="NF">Norfolk Island</option>
                                        <option value="MP">Northern Mariana Islands</option>
                                        <option value="NO">Norway</option>
                                        <option value="OM">Oman</option>
                                        <option value="PK">Pakistan</option>
                                        <option value="PW">Palau</option>
                                        <option value="PS">Palestinian Territories</option>
                                        <option value="PA">Panama</option>
                                        <option value="PG">Papua New Guinea</option>
                                        <option value="PY">Paraguay</option>
                                        <option value="PE">Peru</option>
                                        <option value="PH">Philippines</option>
                                        <option value="PN">Pitcairn</option>
                                        <option value="PL">Poland</option>
                                        <option value="PT">Portugal</option>
                                        <option value="PR">Puerto Rico</option>
                                        <option value="QA">Qatar</option>
                                        <option value="RE">Reunion</option>
                                        <option value="RO">Romania</option>
                                        <option value="RU">Russian Federation</option>
                                        <option value="RW">Rwanda</option>
                                        <option value="BL">Saint Barthelemy</option>
                                        <option value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
                                        <option value="KN">Saint Kitts and Nevis</option>
                                        <option value="LC">Saint Lucia</option>
                                        <option value="MF">Saint Martin</option>
                                        <option value="PM">Saint Pierre and Miquelon</option>
                                        <option value="VC">Saint Vincent and the Grenadines</option>
                                        <option value="WS">Samoa</option>
                                        <option value="SM">San Marino</option>
                                        <option value="ST">Sao Tome and Principe</option>
                                        <option value="SA">Saudi Arabia</option>
                                        <option value="SN">Senegal</option>
                                        <option value="RS">Serbia</option>
                                        <option value="SC">Seychelles</option>
                                        <option value="SL">Sierra Leone</option>
                                        <option value="SG">Singapore</option>
                                        <option value="SX">Sint Maarten</option>
                                        <option value="SK">Slovakia</option>
                                        <option value="SI">Slovenia</option>
                                        <option value="SB">Solomon Islands</option>
                                        <option value="SO">Somalia</option>
                                        <option value="ZA">South Africa</option>
                                        <option value="GS">South Georgia and the South Sandwich Islands</option>
                                        <option value="ES">Spain</option>
                                        <option value="LK">Sri Lanka</option>
                                        <option value="SR">Suriname</option>
                                        <option value="SJ">Svalbard and Jan Mayen</option>
                                        <option value="SZ">Swaziland</option>
                                        <option value="SE">Sweden</option>
                                        <option value="CH">Switzerland</option>
                                        <option value="TW">Taiwan</option>
                                        <option value="TJ">Tajikistan</option>
                                        <option value="TZ">Tanzania, United Republic of</option>
                                        <option value="TH">Thailand</option>
                                        <option value="TL">Timor-leste</option>
                                        <option value="TG">Togo</option>
                                        <option value="TK">Tokelau</option>
                                        <option value="TO">Tonga</option>
                                        <option value="TT">Trinidad and Tobago</option>
                                        <option value="TN">Tunisia</option>
                                        <option value="TR">Turkey</option>
                                        <option value="TM">Turkmenistan</option>
                                        <option value="TC">Turks and Caicos Islands</option>
                                        <option value="TV">Tuvalu</option>
                                        <option value="UG">Uganda</option>
                                        <option value="UA">Ukraine</option>
                                        <option value="AE">United Arab Emirates</option>
                                        <option value="GB">United Kingdom</option>
                                        <option value ="US" SELECTED>United States</option>
                                        <option value="UM">United States Minor Outlying Islands</option>
                                        <option value="UY">Uruguay</option>
                                        <option value="UZ">Uzbekistan</option>
                                        <option value="VU">Vanuatu</option>
                                        <option value="VE">Venezuela</option>
                                        <option value="VN">Vietnam</option>
                                        <option value="VG">Virgin Islands, British</option>
                                        <option value="VI">Virgin Islands, U.S.</option>
                                        <option value="WF">Wallis and Futuna</option>
                                        <option value="EH">Western Sahara</option>
                                        <option value="YE">Yemen</option>
                                        <option value="ZM">Zambia</option>
                                        <option value="ZW">Zimbabwe</option>
                                    </select>
                                    <label for ="country">Country :</label>
                                </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="phno" name="phno" type="text" value="<?php echo $phone;?>">
                                        <label for="phno">Phone number :</label>
                                    </div>
                                </div>
                                <center>
                                    <button class="btn waves-effect waves-light teal" type="submit" name="ship">Ship</button>
                                </center>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </li>
    <li class = "disabled">
        <div class="collapsible-header">Payment method</div>
        <div class="collapsible-body">
            <div class = "shipping_address">
                <div class="container white z-depth-2" >
                    <div id="shipping" class="col s12">
                        <form class="col s12" name="input" action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST">
                            <div class="form-container" >
                                <h4 class="teal-text" style="padding-left: 8em">Enter card details</h4>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="cardnumber" name ="cardnumber" type="text" value="<?php echo $cardnumber;?>" >
                                        <label for="cardnumber">Card Number :</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="fullNamecrd" name ="fullNamecrd" type="text" value="<?php echo $fullnamecrd;?>" >
                                        <label for="fullNamecrd">Name on card :</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                <input type="date" name ="expdate" class="datepicker">
                                        <label for="expdate">Expiry Date :</label>
                                    </div>
                                </div>
                                <center>
                                    <button class="btn waves-effect waves-light teal" type="submit" name="pay">Pay</button>
                                </center>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </li>
    <li>
        <div class="collapsible-header">Review items and shipment</div>
        <div class="collapsible-body">
            <div class = "shipping_address">
                <div class="container white z-depth-2" >
                    <div id="shipping" class="col s12">
                        <form class="col s12" name="input" action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST">
                            <div class="form-container" >
                                <h4 class="teal-text" style="padding-left: 8em">Items and shipment</h4>
                                <?

                                $query3 = "SELECT * FROM session WHERE sessionID=?;";
                                $db->do_query($query3,array(session_id()),array('s'));
                                $result1 = $db->fetch_all_array();

                                $new_user= $result1[0]['username'];

                                $query4 = "SELECT * FROM customer WHERE custEmail=?;";
                                $db->do_query($query4,array($new_user),array('s'));
                                $result2 = $db->fetch_all_array();



                                $new_custID = $result2[0]['custID'];


                                $query5 = "SELECT p.prodID, p.prodName, p.prodImage, p.prodDesc, p.prodPrice, c.quantity, p.genre, p.discount 
                                            FROM
                                            product p 
                                            INNER JOIN
                                            cart c ON c.prodID = p.prodID WHERE custID = $new_custID AND c.quantity > 0";

                                $db->do_query( $query5, array(), array() );


                                echo shipProduct::build_shipcard( $db->fetch_all_array());

                                $q = "SELECT * FROM Shipping WHERE sessionID='$sesid'";
                                $db->do_query($q,array(),array());
                                $result = $db->fetch_all_array();


                                $dbfullname = $result[0]['fullName'];
                                $dbaddr1 = $result[0]['adl1'];
                                $dbaddr2 = $result[0]['adl2'];
                                $dbcity=$result[0]['city'];
                                $dbspr=$result[0]['state'];
                                $dbzip=$result[0]['zip'];
                                $dbcountry=$result[0]['country'];
                                $dbphno=$result[0]['phNo'];
                                $dbcrdnum=$result[0]['cardNum'];
                                $dbfnamecrd=$result[0]['nameCard'];
                                $dbexpd=$result[0]['expDate'];

                                ?>

                                <div id="shipaddr_item">
                                    <p class='teal-text' style = 'padding-left:1em;'><strong> Shippment address details </strong></p>
                                    <p>Name : <? echo $dbfullname?></p>
                                    <p>Address : <?echo $dbaddr1?> <? echo $dbaddr2?></p>
                                    <p>City : <? echo $dbcity?></p>
                                    <p>State/Provice/Region : <? echo $dbspr ?></p>
                                    <p>Zip : <? echo $dbzip?></p>
                                    <p>Country : <? echo $dbcountry?></p>
                                    <p>Phone Number : <? echo $dbphno?></p>
                                </div>

                                <div id="shipcarditems">
                                    <p class='teal-text' style = 'padding-left:1em;'><strong> Customer card details </strong></p>
                                    <p>Card Number : <? echo $dbcrdnum?></p>
                                    <p>Name on card : <?echo $dbfnamecrd?></p>
                                    <p>Expiry date : <? echo $dbexpd?></p>
                                </div>


                                <div id = "shipdays">
                                    <p class='teal-text' style = 'padding-left:1em;'><strong> Select the shipping method of your choice </strong></p>
                                <p>
                                    <input class="with-gap" name="ship" type="radio" id="ship1"  />
                                    <label for="ship1">One-Day shipping $5 extra</label>
                                </p>
                                <p>
                                    <input class="with-gap" name="ship" type="radio" id="ship2"  />
                                    <label for="ship2">Free Two-Day shipping</label>
                                </p>
                                <p>
                                    <input class="with-gap" name="ship" type="radio" id="ship3"  />
                                    <label for="ship3">Within 5 Days shipping, $5 reward </label>
                                </p>
                                </div>
                                <center>
                                    <button class="btn waves-effect waves-light teal" type="submit" name="placeorder">Place order</button>
                                </center>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </li>
</ul>

<?php
if(isset( $_POST["placeorder"] ) && $dbfullname != "" && $dbaddr1 != "" && $dbaddr2 !="" && $dbcity !="" && $dbspr !="" && $dbzip !="" && $dbcountry !="" && $dbphno !=""){
    ?>
    <p class='teal-text' style='padding-left:1em;'><strong> Thank you for shopping , your order is placed and will be
            delivered as requested. <strong></p>
    <?
}
require_once "main/starter/footer.php";
?>
