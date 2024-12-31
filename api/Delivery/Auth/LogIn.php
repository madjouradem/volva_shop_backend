<?php

include "../../../connect.php";



$email = filterRequest("email");
// $password = filterRequest("password");
$password = sha1($_POST["password"]);
// $select = $con->prepare("SELECT * FROM delivery WHERE delivery_email =? and delivery_password =? and delivery_approve =1");
// $select ->execute(array($email,$password));
// $count = $select->rowCount();
// if($count!=0){
//     echo json_encode(array('status'=>'success'));
// }else{
//     fail("none");
// }

getData("delivery",'delivery_email =? and delivery_password =? and delivery_approve =1',array($email,$password));