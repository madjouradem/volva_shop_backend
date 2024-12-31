<?php
include '../../../connect.php';

$orderUserId = filterRequest('order_user_id');
$orderId = filterRequest('order_id');
$orderType = filterRequest('order_type');


    $data=array(
        "order_status"=>"Prepared",
    );
    $count = updateData("orders",$data,"order_id=$orderId and order_status = 'Processing' ",false);
    if($count != 0){
        $count2 = insertNotification('Orders Status','The order has been approved',$orderUserId);
        if($count2 != 0){
        sendFCM('Orders Status','The order has been prepared',"$orderUserId",'','/orders',array('orderId'=>$orderId));
        if($orderType=='delivery'){
            sendFCM('warning',"There is orders waiting approved","delivery",'','',array('orderId'=>$orderId));
        }
        }
    }
