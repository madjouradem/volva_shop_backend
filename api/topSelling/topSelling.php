<?php

include '../../connect.php';

$userId =filterRequest('user_id'); 
getAllData("*,
 case when fav_user_id IS not null THEN 1 else 0 end as favorite ","
  itemwithcategory I  LEFT JOIN favorite   on `item_id` = fav_item_id and fav_user_id = $userId 
 JOIN cart on `item_id` = cart_item_id and cart_user_id =  $userId  and cart_order_id !=0 
 GROUP BY cart_item_id 
 ORDER BY COUNT(`cart_item_id`) DESC 
limit 6",null,null);
