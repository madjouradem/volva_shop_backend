<?php

include '../../connect.php';

$userId = filterRequest('user_id');
$itemId = filterRequest('item_id');

deleteData('favorite',"fav_item_id =$itemId and fav_user_id = $userId");
