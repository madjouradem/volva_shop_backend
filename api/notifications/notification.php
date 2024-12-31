<?php

include '../../connect.php';

$userId =filterRequest('user_id');

getAllData('*','notifications',"notification_reciver_id = $userId");