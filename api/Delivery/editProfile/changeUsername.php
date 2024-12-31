<?php

include '../../../connect.php';

$deliveryId = filterRequest('delivery_id');
$deliveryName = filterRequest('delivery_name');
$data=array('delivery_name'=>$deliveryName);
updateData('delivery',$data,"delivery_id=$deliveryId");