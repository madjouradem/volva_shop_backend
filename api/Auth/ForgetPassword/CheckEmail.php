<?php

include "../../../connect.php";

$email = filterRequest("email");
$verfiycode =rand(10000,99999);


$select = $con->prepare("SELECT * From users where user_email = ? ");
$select ->execute(array($email));
$count = $select->rowCount();
if($count !=0){
//sendMail();
$data =array("user_verfiycode"=>$verfiycode);
updateData("users",$data,"user_email = '$email'");
}else{
      fail("email not valid");
}