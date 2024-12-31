<?php

include '../../connect.php';

$userId = filterRequest('user_id');

getAllData("*, 1 as favorite","itemwithcategory  JOIN favorite  on `item_id` = fav_item_id where fav_user_id = $userId ");

