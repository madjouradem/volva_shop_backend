<?php

include '../../connect.php';

$userId = filterRequest('user_id');
$itemId = filterRequest('item_id');
$itemPrice = filterRequest('item_price');

$count = getAllData('cart_id','cart',"cart_user_id=$userId and cart_item_id=$itemId and cart_order_id = 0",null,false);

if($count != 0 ){

    // $stmt = $con->prepare("UPDATE `cart` SET `cart_count`=`cart_count`+1 WHERE cart_user_id=$userId and cart_item_id=$itemId");
    // $stmt->execute();
    // $coun = $stmt->rowCount();
    // if ($coun > 0) {
        echo json_encode(array("status" => "success"));
    // }else{
    //     echo json_encode(array("status" => "failure"));
    // }

}else{
    insertData("cart",array('cart_user_id'=>$userId,'cart_item_id'=>$itemId,'cart_price'=>$itemPrice));
}


