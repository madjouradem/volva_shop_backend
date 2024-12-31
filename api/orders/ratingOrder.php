<?php
include '../../connect.php';

$orderId = filterRequest('order_id');
$orderRating = filterRequest('order_rating');
$orderComment = filterRequest('order_comment');

$data = array(
    "order_rating"=>$orderRating,
    "order_comment"=>$orderComment,
);

updateData('orders',$data,"order_id = $orderId");