<?php

include '../../connect.php';

$userId = filterRequest('user_id');
$itemId = filterRequest('item_id');


insertData("favorite",array('fav_user_id'=>$userId,'fav_item_id'=>$itemId));


