<?php

include '../../connect.php';

$addressId = filterRequest('address_id');
// $userId = filterRequest('user_id');
$city = filterRequest('city');
$street = filterRequest('street');
$lat = filterRequest('lat');
$lng = filterRequest('lng');


updateData("address",
array('address_city'=>$city,'address_strees'=>$street,'address_lat'=>$lat,'address_lng'=>$lng),
"address_id=$addressId");

//address_id // address_user_id //	address_city // address_strees// address_lat //	address_lng	

