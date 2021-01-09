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

$area = $requests['area'];
$sql="SELECT user_ID,name,treatment_area from user where type = 'chief nurse' and treatment_area = '$area'";
$result = $conn->query($sql);
$row = mysqli_fetch_assoc($result);
$msg = [];



$newRow = ['id'=>$row['user_ID'],'name'=>$row['name'],'area'=>$row['treatment_area']];
array_push($msg,$newRow);
echo json_encode($msg);


mysqli_close($conn);
?>