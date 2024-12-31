<?php

include '../../connect.php';

$orderId = filterRequest('order_id');

deleteData("orders","order_id=$orderId and order_status = 'Pending'");

