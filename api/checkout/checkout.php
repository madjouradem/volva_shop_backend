<?php
include '../../connect.php';

$orderUserId = filterRequest('order_user_id');
$orderAddress = filterRequest('order_address');
$orderType = filterRequest('order_type');
$orderPayType = filterRequest('order_pay_type');//

$orderPriceDelivery = filterRequest('order_price_delivery');
$orderPrice = filterRequest('order_price');
$orderCoupon = filterRequest('order_coupon');

$couponId = filterRequest('coupon_id');//
$cartItemIDs =filterRequest('cartItemIDs');
global $Unstablequantity ;

        //  statement for check is there is still a 
        // items count 
       
        $sql ="(".$cartItemIDs.")";
       
     
        $stmt = $con->prepare("SELECT items.item_id ,
        case WHEN items.ititem_count > cart_count THEN 1 ELSE 0   END as countcheck
        FROM `cart` JOIN items on cart_item_id = item_id 
        WHERE item_id in $sql and cart_user_id = $orderUserId
        ");
        $stmt->execute();
        $data =$stmt->fetchAll(PDO::FETCH_ASSOC);

         for($i = 0 ;$i<count($data) ;$i++){
            if($data[$i]['countcheck']=='0'){
                $Unstablequantity = $data[$i];
            }
        };

    ////// add order
    if($Unstablequantity == null  ){

        $stmt = $con->prepare("INSERT INTO 
        `orders`( `order_user_id`, `order_address`, `order_type`,`order_pay_type`,
        `order_price_delivery`, `order_price`, `order_coupon`) 
        VALUES (?,?,?,?,?,?,?)
        ");
        $stmt->execute(array($orderUserId,$orderAddress,$orderType,$orderPayType,$orderPriceDelivery,$orderPrice,$orderCoupon));
        $data =$stmt->fetchAll(PDO::FETCH_ASSOC);
        $count = $stmt->rowCount();
        if($count != 0 ){
                  //update cart order id

                $data2  = array("cart_order_id"=>$con->lastInsertId());
                $count2 = updateData("cart",$data2,"cart_item_id in $sql and cart_user_id = $orderUserId and cart_order_id = 0 ",false);


                 //update coupon count
                $data3  = array("coupon_count" =>`coupon_count`-1);
                $stmt2 = $con->prepare("UPDATE `coupon` SET `coupon_count`=`coupon_count`-1 WHERE coupon_id = $couponId");
                $stmt2->execute();
                $count3 = $stmt2->rowCount();

                //check is every thing is okay
                if($count2!=0  ){
                    echo json_encode(array('status'=>'success'));
                
                }else{
                    echo json_encode(array('status'=>'failure'));
                }
        }else{
            echo json_encode(array('status'=>'failure'));
        }
    }else{
        echo json_encode(array('status'=>'quantityfailure'));
    }


//=======================> add coupon id as filter request


// $data = array(
// "order_user_id"=>$orderUserId,
// "order_address"=>$orderAddress,
// "order_type"=>$orderType,
// "order_price_delivery"=>$orderPriceDelivery,
// "order_price"=>$orderPrice,
// "order_coupon"=>$orderCoupon,
// // "order_pay_method"=>$orderPayMethod,
// );