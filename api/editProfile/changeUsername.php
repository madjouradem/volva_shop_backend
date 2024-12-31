<?php

include '../../connect.php';

$userId = filterRequest('user_id');
$userName = filterRequest('user_name');
$data=array('user_name'=>$userName);
updateData('users',$data,"user_id=$userId");