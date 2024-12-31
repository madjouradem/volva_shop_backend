<?php

include '../../connect.php';

$userId = filterRequest('user_id');


$categories= getAllData('*','categories',null,null,false);
$data['categories'] =$categories; 
$settings= getAllData('*','settings',null,null,false);
$data['settings'] =$settings; 
$items= getAllData("*, case when fav_user_id IS not null THEN 1 else 0 end as favorite ,case when cart_user_id IS not null THEN 1 else 0 end as cart ","itemwithcategory I  LEFT JOIN favorite   on `item_id` = fav_item_id and fav_user_id = $userId LEFT JOIN cart on `item_id` = cart_item_id and cart_user_id =  $userId  and cart_order_id = 0",null,null,false);
$data['items']=$items;
$offers =  getAllData("*, case when fav_user_id IS not null THEN 1 else 0 end as favorite ,case when cart_user_id IS not null THEN 1 else 0 end as cart ","itemwithcategory I  LEFT JOIN favorite   on `item_id` = fav_item_id and fav_user_id = $userId LEFT JOIN cart on `item_id` = cart_item_id and cart_user_id =  $userId  and cart_order_id = 0 where item_discount !=0 order by item_discount desc limit 6",null,null,false);
$data['offers']=$offers;
$topSelling =  getAllData("*, case when fav_user_id IS not null THEN 1 else 0 end as favorite ,case when cart_user_id IS not null THEN 1 else 0 end as cart"," itemwithcategory I  LEFT JOIN favorite   on `item_id` = fav_item_id and fav_user_id = $userId JOIN cart on `item_id` = cart_item_id and cart_user_id =  $userId  and cart_order_id !=0 GROUP BY cart_item_id ORDER BY COUNT(cart_item_id) DESC limit 6",null,null,false);
$data['topSelling']=$topSelling;
echo json_encode(array('status'=>'success','data'=>$data));