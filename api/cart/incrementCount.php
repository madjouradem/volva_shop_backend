<?php

include '../../connect.php';

$cartId = filterRequest('cart_id');
$itemId = filterRequest('item_id');
$itemPrice = filterRequest('item_price');



$data =  getAllData('ititem_count','items',"items.item_id = $itemId",null,false);

$itemCount = $data[0]['ititem_count'];

$stmt = $con->prepare("
UPDATE `cart` SET `cart_count`= 
CASE WHEN `cart_count` < $itemCount
THEN `cart_count` + 1 
else $itemCount
END ,
`cart_price`= $itemPrice * `cart_count`

WHERE cart_id=$cartId

");
$stmt->execute();
$coun = $stmt->rowCount();
if ($coun > 0) {
    echo json_encode(array("status" => "success"));
}else{
    echo json_encode(array("status" => "failure"));
}




