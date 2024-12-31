<?php

include "../../../connect.php";

$email = filterRequest("email");
$verfiycode = filterRequest("verfiycode");


$select = $con->prepare("SELECT * From users where user_email = ? and user_verfiycode = ?");
$select ->execute(array($email,$verfiycode));
$count = $select->rowCount();

if($count !=0){
  echo json_encode(array("status"=>"success"));
}else{
  fail("code not valid");
}
