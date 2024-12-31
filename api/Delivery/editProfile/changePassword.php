<?php

include '../../../connect.php';

$deliveryId = filterRequest('delivery_id');
$deliveryPassword = sha1(filterRequest('delivery_password'));
$data=array('delivery_password'=>$deliveryPassword);
updateData('delivery',$data,"delivery_id=$deliveryId");