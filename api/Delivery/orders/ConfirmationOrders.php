<?php
include '../../../connect.php';

$orderUserId = filterRequest('order_user_id');
$orderId = filterRequest('order_id');
$deliveryId = filterRequest('delivery_id');

$data=array(
    "order_status"=>"Out for Delivery",
    "order_delivery_id"=>$deliveryId,
);

$count = updateData("orders",$data,"order_id=$orderId and order_status = 'Prepared' ",false);

if($count != 0){
    $count2 = insertNotification('Orders Status','The order has been approved',$orderUserId);
    if($count2 != 0){
    sendFCM('Orders Status','your order on the way',"$orderUserId",'','/orders',array('orderId'=>$orderId));
    sendFCM('Warning',"the order has been approved by delivery $deliveryId","admin",'','/orders',array('orderId'=>$orderId));
    sendFCM('Warning',"the order has been approved by delivery $deliveryId","delivery",'','/orders',array('orderId'=>$orderId));
    }
}