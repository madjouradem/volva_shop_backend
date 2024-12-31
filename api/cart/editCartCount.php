<?php

include '../../connect.php';

$cartId = filterRequest('cart_id');
$count = filterRequest('count');
$price = filterRequest('price');

$data=array(
    "cart_count"=>$count,
    "cart_price"=>$price,
);

updateData('cart',$data,"cart_id=$cartId");
