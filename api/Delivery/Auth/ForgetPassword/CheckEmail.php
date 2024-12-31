<?php

include "../../../../connect.php";

$email = filterRequest("email");
$verfiycode =rand(10000,99999);


$select = $con->prepare("SELECT * From delivery where delivery_email = ? ");
$select ->execute(array($email));
$count = $select->rowCount();
if($count !=0){
//sendMail();
$data =array("delivery_verfiycode"=>$verfiycode);
updateData("delivery",$data,"delivery_email = '$email'");
}else{
      fail("email not valid");
}