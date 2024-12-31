<?php

include '../connect.php';
$dir = filterRequest('dir');


$file = fileUpload('file',"../upload/"."$dir");