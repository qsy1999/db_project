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

$id = $requests['id'];

$sql = "SELECT * FROM patient_status WHERE patient_ID = '$id'";
$result = $conn->query($sql);
$set = array();
while(($row = mysqli_fetch_assoc($result))){
    $res_id = $row['result_ID'];
    $sql2 = "SELECT * FROM nucleic_acid_testing_result WHERE result_ID = $res_id";
    $result2 = $conn->query($sql2);
    $row2 = mysqli_fetch_assoc($result2);
    $return_row = [
    'time'=>$row['time'],
    'recorder'=>$row['recorder_ID'],
    'temperature'=>$row['temperature'],
    'symptom'=>$row['symptom'],
    'life_status'=>$row['life_status'],
    'result'=>$row2['result'],
    'level'=>$row2['level'],
    'NA_recorder'=>$row2['recorder_ID'],
    'NA_time'=>$row2['time'],
    ];
    array_push($set,$return_row);
}

$sql = "SELECT * FROM nucleic_acid_testing_result WHERE patient_ID = '$id'";
$result = $conn->query($sql);
$set2 = array();
while(($row = mysqli_fetch_assoc($result))){
    $return_row = [
    'result'=>$row['result'],
    'level'=>$row['level'],
    'NA_recorder'=>$row['recorder_ID'],
    'NA_time'=>$row['time'],
    ];
    array_push($set2,$return_row);
}

$set_res = array();
array_push($set_res,$set,$set2);

$sql = "select life_status from patient_status where patient_ID = '$id' order by record_ID desc limit 1 ";
$result = $conn->query($sql);
$row = mysqli_fetch_assoc($result);
array_push($set_res, $row);
$sql = "select distinct patient_ID from message where patient_ID = '$id'   ";
$result = $conn->query($sql);
$row = mysqli_fetch_assoc($result);
if(!$row){
    array_push($set_res, ['dischargeable'=>false]);
}else{
    array_push($set_res, ['dischargeable'=>true]);
}


echo json_encode($set_res);

   
mysqli_close($conn);
?>