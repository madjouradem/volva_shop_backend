<?php

include '../../connect.php';

$userId =filterRequest('user_id'); 
getAllData("*, case when fav_user_id IS not null THEN 1 else 0 end as favorite ,case when cart_user_id IS not null THEN 1 else 0 end as cart ","itemwithcategory I  LEFT JOIN favorite   on `item_id` = fav_item_id and fav_user_id = $userId LEFT JOIN cart on `item_id` = cart_item_id and cart_user_id =  $userId  and cart_order_id = 0 where item_discount !=0 order by item_discount desc limit 20",null,null);