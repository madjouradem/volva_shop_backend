<?php

include '../../connect.php';

$where = "";
$itemType = filterRequest('items_type');
$userId = filterRequest('user_id');


switch ($itemType){
    case 'all' : $where='' ;
    break ;
    case 'best saler' : $where='' ;
    break ;
    case 'for you' : $where='' ;
    break ;
    case 'by Cat' : $catId =  filterRequest('cat_id'); $where="item_cat_id=$catId" ;
    break ;
}

getAllData("*, case when fav_user_id IS not null THEN 1 else 0 end as favorite ","itemwithcategory I  LEFT JOIN favorite on `item_id` = fav_item_id and fav_user_id =$userId ",$where);


