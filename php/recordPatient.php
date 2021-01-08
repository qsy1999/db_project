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

$id=$requests['id'];
$targetID=$requests['targetID'];
$temperature=$requests['temperature'];
$symptom=$requests['symptom'];
$life_status=$requests['life_status'];
$time=$requests['time'];

$time=substr($time,0,10)." ".substr($time,11,8);

$sql = "SELECT bed_ID FROM bed WHERE patient_ID = $targetID";
$result = $conn->query($sql);
$row =mysqli_fetch_assoc($result);
$bed_ID = $row['bed_ID'];

$sql = "SELECT result_ID , time FROM nucleic_acid_testing_result WHERE patient_ID = $targetID ORDER BY time desc";
$result = $conn->query($sql);
$row =mysqli_fetch_assoc($result);
$result_ID = $row['result_ID'];

$sql = "INSERT INTO patient_status (patient_ID,result_ID,bed_ID,recorder_ID,temperature,symptom,life_status,time) VALUES ($targetID,$result_ID,$bed_ID,$id,'$temperature','$symptom','$life_status','$time')";
$result = $conn->query($sql);


if(!$result){
    $msg=['success'=>$sql];
    echo json_encode($msg);
}
else {
    $msg=['success'=>'1'];
    echo json_encode($msg);
}
   
mysqli_close($conn);
?>