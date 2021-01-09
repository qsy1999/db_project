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


$target = $requests['target'];


$sql = "select distinct patient.* from message , patient where message.towards = $target and message.patient_ID = patient.patient_ID";
$result = $conn->query($sql);
$set = array();
if(!$result){
    $msg=['success'=>$sql];
    echo json_encode($msg);
}
else {
    while(($row = mysqli_fetch_assoc($result))){
        $newRow = ['id'=>$row['patient_ID'],'name'=>$row['name'],'area'=>$row['treatment_area']];
        array_push($set,$newRow);
    }

    echo json_encode($set);


    
    // $msg=['success'=>$sql];
    // echo json_encode($msg);
   
}




mysqli_close($conn);
?>