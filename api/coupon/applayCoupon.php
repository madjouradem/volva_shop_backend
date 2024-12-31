<?php
include '../../connect.php';

$couponName = filterRequest('coupon_name');
$now = date('Y-m-d H:i:s');
getData('coupon',"`coupon_name` = ? and coupon_expired > ? and  `coupon_count` > 0 ",array($couponName,$now));