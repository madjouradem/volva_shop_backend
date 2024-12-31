<?php

include '../../connect.php';

$userId = filterRequest('user_id');
$userImage = filterRequest('user_image');

$data=array('user_image'=>$userImage);
updateData('users',$data,"user_id=$userId");