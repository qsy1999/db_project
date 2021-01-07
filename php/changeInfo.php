<?php
$dbhost = 'localhost:3306';  // mysql服务器主机地址
$dbuser = 'master';            // mysql用户名
$dbpass = '123456';          // mysql用户名密码
$conn = mysqli_connect($dbhost, $dbuser, $dbpass);
if(! $conn )
{
    die('连接失败: ' . mysqli_error($conn));
}

mysqli_select_db( $conn, 'hospital' );

$postData = file_get_contents('php://input');
$requests = !empty($postData) ? json_decode($postData, true) : array();

$user_ID = $requests['user_ID'];
$newPassword = $requests['newPassword'];
$newName = $requests['newName'];
if($newPassword != '' && $newName != ''){
    $sql = "UPDATE  user set `password` = '$newPassword', `name` = '$newName' WHERE `user_ID` = '$user_ID'";
}
else if($newPassword == '' && $newName != ''){
    $sql = "UPDATE  user set `name` = '$newName' WHERE `user_ID` = '$user_ID'";
}
else if($newPassword != '' && $newName == ''){
    $sql = "UPDATE  user set `password` = '$newPassword' WHERE `user_ID` = '$user_ID'";
}


$result = $conn->query($sql);

if(!$result){
    $msg=['success'=>'0'];
    echo json_encode($msg);
}
else {
    $msg=['success'=>'1'];
    echo json_encode($msg);
}
   
mysqli_close($conn);
?>