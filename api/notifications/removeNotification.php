<?php

include '../../connect.php';

$notificationId =filterRequest('notification_id');

deleteData('notifications',"notification_id = $notificationId");
