<?php

include '../../connect.php';

$orderId = filterRequest('order_id');

$from ='`cart` JOIN orders on cart_order_id = orders.order_id JOIN items on items.item_id = cart_item_id LEFT JOIN address on address.address_id = orders.order_address LEFT JOIN coupon ON order_coupon = coupon.coupon_id
';
getAllData("*",$from,"orders.order_id = $orderId");

