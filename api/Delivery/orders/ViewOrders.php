<?php
include '../../../connect.php';

$deliveryId =filterRequest('delivery_id');

getAllData("*","orders join users on user_id = order_user_id join address on address_id = order_address","order_status = 'Prepared' or (order_status = 'Out for Delivery' and order_delivery_id =$deliveryId ) order by order_id desc",);
