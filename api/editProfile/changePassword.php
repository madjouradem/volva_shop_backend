<?php

include '../../connect.php';

$userId = filterRequest('user_id');
$userPassword = sha1(filterRequest('user_password'));
$data=array('user_password'=>$userPassword);
updateData('users',$data,"user_id=$userId");