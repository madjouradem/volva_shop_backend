<?php

include '../../connect.php';

$categoryId = filterRequest('cat_id');
$userId = filterRequest('user_id');

$subCategories= getAllData('*','subcategory','subcat_cat_id = ?',array($categoryId),false);
$data['subCategories'] =$subCategories; 
$items= getAllData("*, case when fav_user_id IS not null THEN 1 else 0 end as favorite,case when cart_user_id IS not null THEN 1 else 0 end as cart ","itemwithcategory I  LEFT JOIN favorite   on `item_id` = fav_item_id and fav_user_id =$userId LEFT JOIN cart on `item_id` = cart_item_id and cart_user_id =  $userId ",'item_cat_id=?',array($categoryId),false);


$data['items']=$items;
echo json_encode(array('status'=>'success','data'=>$data));
