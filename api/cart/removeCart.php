<?php

include '../../connect.php';

$userId = filterRequest('user_id');
$itemId = filterRequest('item_id');

deleteData('cart',"cart_item_id =$itemId and cart_user_id = $userId");
