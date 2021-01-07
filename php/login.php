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
$password = $requests['password'];

$sql = "SELECT * FROM user WHERE `user_ID` = '$user_ID'and `password` = '$password'";
$result = $conn->query($sql);

if($result->num_rows == 0){
    $msg=['login'=>'0'];
    echo json_encode($msg);
}else{    
    $row = mysqli_fetch_assoc($result);
    $msg = ['login'=>'1','name'=>$row['name']];
    echo json_encode($msg);
    
}



mysqli_close($conn);
?>