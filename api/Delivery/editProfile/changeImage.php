<?php

include '../../../connect.php';

$deliveryId = filterRequest('delivery_id');
$deliveryImage = filterRequest('delivery_image');

$data=array('delivery_image'=>$deliveryImage);
updateData('delivery',$data,"delivery_id=$deliveryId");