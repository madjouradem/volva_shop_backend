<?php

include '../../connect.php';

$cartId = filterRequest('cart_id');
$itemId = filterRequest('item_id');
$itemPrice = filterRequest('item_price');
$count = filterRequest('count');



$data =  getAllData('ititem_count','items',"items.item_id = $itemId",null,false);

$itemCount = $data[0]['ititem_count'];

$stmt = $con->prepare("
UPDATE `cart` SET `cart_count`= 
CASE WHEN $count < $itemCount
THEN $count
else $itemCount
END ,
`cart_price`= $itemPrice * `cart_count`

WHERE cart_id=$cartId
");
$stmt->execute();
$coun = $stmt->rowCount();
if ($coun > 0) {
    if($count < $itemCount){
        $data = $count;
    }else{
        $data = $itemCount;
    }
    echo json_encode(array("status" => "success",'data'=>$data));
}else{
    echo json_encode(array("status" => "failure"));
}




