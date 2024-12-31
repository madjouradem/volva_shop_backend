<?php

include '../../connect.php';

$cartId = filterRequest('cart_id');
$itemPrice = filterRequest('item_price');

$stmt = $con->prepare("
UPDATE `cart` SET `cart_count`= 
CASE WHEN `cart_count` > 1
THEN `cart_count` - 1 
else 1
END ,
`cart_price`= $itemPrice * `cart_count`

WHERE cart_id=$cartId");
$stmt->execute();
$coun = $stmt->rowCount();
if ($coun > 0) {
    echo json_encode(array("status" => "success"));
}else{
    echo json_encode(array("status" => "failure"));
}




