<?php

include '../../connect.php';

$userId = filterRequest('user_id');

getAllData("*, 1 as isCart","itemwithcategory JOIN cart  on `item_id` = cart_item_id where cart_user_id = $userId and cart_order_id = 0");

