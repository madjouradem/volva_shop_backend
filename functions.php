<?php

define("MB", 1048576);

function filterRequest($requestname)
{
  return  htmlspecialchars(strip_tags($_POST[$requestname]));
}

function getAllData($column,$table, $where = null, $values = null,$json=true)
{
    global $con;
    $data = array();
    if($where==null){
        $stmt = $con->prepare("SELECT $column FROM $table  ");

    }else{
    $stmt = $con->prepare("SELECT $column FROM $table WHERE   $where ");

    }
    $stmt->execute($values);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $count  = $stmt->rowCount();
    if($json==true){

    if ($count > 0){
        echo json_encode(array("status" => "success", "data" => $data));
    } else {
        echo json_encode(array("status" => "failure"));
    }
}else{
    
    if ($count > 0){
        return $data;
    } else {
    }
}

    return $count;
}

function getAllData2($table,$dataName, $where = null, $values = null)
{
    global $con;
    $data = array();
    if($where==null){
        $stmt = $con->prepare("SELECT  * FROM $table  ");

    }else{
    $stmt = $con->prepare("SELECT  * FROM $table WHERE   $where ");

    }
    $stmt->execute($values);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $count  = $stmt->rowCount();
    if ($count > 0){
        echo json_encode(array($dataName => $data));
    } else {
        echo json_encode(array("status" => "failure"));
    }
   

    return $count;
}

function getData($table, $where = null, $values = null,$json = true)
{
    global $con;
    $data = array();
    if($where==null){
        $stmt = $con->prepare("SELECT  * FROM $table  ");

    }else{
    $stmt = $con->prepare("SELECT  * FROM $table WHERE   $where ");

    }
    $stmt->execute($values);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    $count  = $stmt->rowCount();
    if($json==true){
    if ($count > 0){
        echo json_encode(array("status" => "success", "data" => $data));
    } else {
        echo json_encode(array("status" => "failure"));
     }
    }
    return $count;
}

function insertData($table, $data, $json = true)
{
    global $con;
    foreach ($data as $field => $v)
        $ins[] = ':' . $field;
    $ins = implode(',', $ins);
    $fields = implode(',', array_keys($data));
    $sql = "INSERT INTO $table ($fields) VALUES ($ins)";
    $stmt = $con->prepare($sql);
    foreach ($data as $f => $v) {
        $stmt->bindValue(':' . $f, $v);
    }
    $stmt->execute();
    $count = $stmt->rowCount();
    
    if ($json == true) {
    if ($count > 0) {
        echo json_encode(array("status" => "success"));
    } else {
        echo json_encode(array("status" => "failure"));
    }
  }
    return $count ;
}


function updateData($table, $data, $where, $json = true)
{
    global $con;
    $cols = array();
    $vals = array();

    foreach ($data as $key => $val) {
        $vals[] = "$val";
        $cols[] = "`$key` =  ? ";
    }
    $sql = "UPDATE $table SET " . implode(', ', $cols) . " WHERE $where";

    $stmt = $con->prepare($sql);
    $stmt->execute($vals);
    $count = $stmt->rowCount();
    if ($json == true) {
    if ($count > 0) {
        echo json_encode(array("status" => "success"));
    } else {
        echo json_encode(array("status" => "failure"));
    }
    }
    return $count;
}

function deleteData($table, $where, $json = true)
{
    global $con;
    $stmt = $con->prepare("DELETE FROM $table WHERE $where");
    $stmt->execute();
    $count = $stmt->rowCount();
    if ($json == true) {
        if ($count > 0) {
            echo json_encode(array("status" => "success"));
        } else {
            echo json_encode(array("status" => "failure"));
        }
    }
    return $count;
}

function fileupload($imageRequest,$dir='')
{
  global $msgError;
  $imagename  = rand(10,10000).$_FILES[$imageRequest]['name'];
  $imagetmp   = $_FILES[$imageRequest]['tmp_name'];
  $imagesize  = $_FILES[$imageRequest]['size'];
  $allowExt   = array("pdf","png","jpg","jpeg","mp4","docs");
  $strToArray = explode(".", $imagename);
  $ext        = end($strToArray);
  $ext        = strtolower($ext);

  if (!empty($imagename) && !in_array($ext, $allowExt)) {
    $msgError = "EXT";
  }
  if ($imagesize > 30 * MB) {
    $msgError = "size";
  }
  if (empty($msgError)) {
    if($dir==''){
    move_uploaded_file($imagetmp,  "../upload/". $imagename);
    return $imagename;
    }else{
    move_uploaded_file($imagetmp,  $dir."/".$imagename);
    echo json_encode(array('status'=>'success','name'=>$imagename));
    return $imagename;
    }
  } else {
    echo json_encode(array('status'=>'failure'));
  }
  return null;
}



function deleteFile($dir, $imagename)
{
    if (file_exists($dir )) {
        unlink($dir);
    }
}

function checkAuthenticate()
{
    if (isset($_SERVER['PHP_AUTH_USER'])  && isset($_SERVER['PHP_AUTH_PW'])) {
        if ($_SERVER['PHP_AUTH_USER'] != "your_user_name" ||  $_SERVER['PHP_AUTH_PW'] != "password") {
            header('WWW-Authenticate: Basic realm="My Realm"');
            header('HTTP/1.0 401 Unauthorized');
            echo 'Page Not Found';
            exit;
        }
    } else {
        exit;
    }

    // End 
}

function fail($msg){
    echo json_encode(array('status'=>'fail','message'=> $msg));
}



function sendMail($to,$title,$body){

    $header = "From : madjour.rf.gd "."\n"."CC:madjoura5@gmail.com";

 mail($to,$title,$body,$header);
    
 }
 
function sendFCM($title, $message, $topic, $pageid, $pagename,$data)
{

    $url = 'https://fcm.googleapis.com/fcm/send';

    $fields = array(
        "to" => '/topics/' . $topic,
        'priority' => 'high',
        'content_available' => true,

        'notification' => array(
            "body" =>  $message,
            "title" =>  $title,
            "click_action" => "FLUTTER_NOTIFICATION_CLICK",
            "sound" => "default"

        ),
        'data' => array(
            "pageid" => $pageid,
            "pagename" => $pagename,
            "order_id"=>$data['orderId']
        )

    );
    $fields = json_encode($fields);
    $headers = array(
        'Authorization: key=' . "Your Key",
        'Content-Type: application/json'
    );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

    $result = curl_exec($ch);
    return $result;
    curl_close($ch);
}

function deleteDirectory($dir) {
    if (!file_exists($dir)) {
        return true;
    }

    if (!is_dir($dir)) {
        return unlink($dir);
    }

    foreach (scandir($dir) as $item) {
        if ($item == '.' || $item == '..') {
            continue;
        }

        if (!deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
            return false;
        }

    }

    return rmdir($dir);
}


function insertNotification($title,$body,$userId){
    global $con;
    $stmt = $con->prepare("INSERT INTO `notifications`( `notification_title`, `notification_body`, `notification_reciver_id`) 
    VALUES (?,?,?)");
    $stmt->execute(array($title,$body,$userId));
    $count = $stmt->rowCount();

    if($count != 0){
        echo json_encode(array("status"=>"success"));        
    }else{
        echo json_encode(array("status"=>"failure"));
    }

    return $count;
    
}