<?php

include "../../connect.php";



$email = filterRequest("email");
// $password = filterRequest("password");
$password = sha1($_POST["password"]);
// $select = $con->prepare("SELECT * FROM users WHERE user_email =? and user_password =? and user_approve =1");
// $select ->execute(array($email,$password));
// $count = $select->rowCount();
// if($count!=0){
//     echo json_encode(array('status'=>'success'));
// }else{
//     fail("none");
// }

getData("users",'user_email =? and user_password =? and user_approve =1',array($email,$password));