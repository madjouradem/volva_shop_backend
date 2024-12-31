<?php

include '../../connect.php';

$username =filterRequest("username");
$email    =filterRequest("email");
$password =sha1($_POST["password"]);
$verfiycode =rand(10000,99999);

$select = $con->prepare("SELECT * FROM users WHERE user_email = ? ");
$select->execute(array($email));
$count  =$select->rowCount();

if($count!=0){
 fail('fail email');
}else{
 $tabel = 'users';
 $data  = array(
    'user_name' =>$username,
    'user_email' =>$email,
    'user_password'=>$password,
    'user_verfiycode'=>$verfiycode,
 );
 //sendMail($email,"Verfiy code ","Verfiy code From Ecommerce App : ".$verfiycode);
 insertData($tabel,$data);

}