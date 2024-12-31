<?php
include '../../../connect.php';

$deliveryId =filterRequest('delivery_id');

getAllData("*","orders join address on address_id = order_address","(order_status = 'Out for Delivery' or order_status = 'Delivered'  ) and order_delivery_id =$deliveryId order by order_id desc");
