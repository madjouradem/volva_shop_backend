<?php

include '../../connect.php';

$userId = filterRequest('user_id');

getAllData("*","address","address_user_id=$userId");

