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

$name = $requests['name'];
$area = $requests['area'];
$password = $requests['password'];

$sql =  "INSERT INTO user ".
        "(name,password,type,treatment_area) ".
        "VALUES ".
        "('$name','$password','hospital nurse','$area')";

$result = $conn->query($sql);

$sql =  "SELECT LAST_INSERT_ID() as lastID";
$result = $conn->query($sql);
$row = mysqli_fetch_assoc($result);
$nurse_ID=$row['lastID'];

$sql = "SELECT bed_ID FROM bed WHERE duty_nurse_ID IS NULL and treatment_area = '$area'";
$result = $conn->query($sql);
$fin_result = true;

if($area=="mild") $limit = 3 ;
if($area=="intense") $limit = 2 ;
if($area=="critical") $limit = 1 ;


for($i = 0 ; $i<$result->num_rows && $i<$limit ;$i++)
{
    $row = mysqli_fetch_assoc($result);
    $bed_ID = $row['bed_ID'];
    $sql = "UPDATE bed set duty_nurse_ID = '$nurse_ID' WHERE bed_ID = '$bed_ID'";
    $fin_result = $conn->query($sql);
}

if(!$fin_result){
    $msg=['success'=>'0'];
    echo json_encode($msg);
}
else {
    $msg=['success'=>'1'];
    echo json_encode($msg);
}

mysqli_close($conn);
?>