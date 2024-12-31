<?php
include '../../../connect.php';

$orderUserId = filterRequest('order_user_id');
$orderId = filterRequest('order_id');

$data=array(
    "order_status"=>"Processing",
);

$count = updateData("orders",$data,"order_id=$orderId and order_status = 'Pending' ",false);

if($count != 0){
    $count2 = insertNotification('Orders Status','The order has been approved',$orderUserId);
   
    if($count2 != 0){
    sendFCM('Orders Status','The order has been approved',"$orderUserId",'','/orders',array('orderId'=>$orderId));    
    }
}