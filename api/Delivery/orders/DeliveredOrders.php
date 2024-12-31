<?php
include '../../../connect.php';

$orderUserId = filterRequest('order_user_id');
$orderId = filterRequest('order_id');

$data=array(
    "order_status"=>"Delivered",
);

$count = updateData("orders",$data,"order_id=$orderId and order_status = 'Out for Delivery' ",false);

if($count != 0){
    $count2 = insertNotification('Orders Status','The order has been approved',$orderUserId);
    if($count2 != 0){
    sendFCM('Orders Status','your order has been Delivered',"$orderUserId",'','/orders',array('orderId'=>$orderId));
    sendFCM('Warning','The order has been delivered to the customer',"admin",'','/orders',array('orderId'=>$orderId));
    }
}