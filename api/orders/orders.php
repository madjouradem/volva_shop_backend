<?php

include '../../connect.php';

$userId = filterRequest('user_id');

getAllData("*","orders left join delivery on `order_delivery_id` = delivery_id  join address on `order_address`=address_id","order_user_id=$userId order by order_id desc");

