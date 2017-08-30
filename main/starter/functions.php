

<?php


function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function secure_generate_salt($cost = 12) {
    $salt = '$2a$' . str_pad($cost, 2, '0', STR_PAD_LEFT) . '$';
    $salt .= substr(str_replace('+', '.', base64_encode(openssl_random_pseudo_bytes(16))), 0, 22);
    return $salt;
}





?>