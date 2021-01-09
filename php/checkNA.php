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
$targetID = $requests['targetID'];
$result = $requests['result'];
$time = $requests['time'];
$level = $requests['level'];

$time=substr($time,0,10)." ".substr($time,11,8);


$sql = "INSERT INTO nucleic_acid_testing_result (patient_ID,recorder_ID,result,time,level) VALUES ($targetID,$id,'$result','$time','$level')";
$result = $conn->query($sql);


if(!$result){
    $msg=['success'=>$sql];
    echo json_encode($msg);
}
else {
    $msg=['success'=>'1'];
    echo json_encode($msg);
}
//find most 2 recent  nucleic_acid_testing_result 
$sql = "select result ,time  from nucleic_acid_testing_result where nucleic_acid_testing_result.patient_ID = $targetID order by result_ID desc limit 2";
$result = $conn->query($sql);
$nuc = [];
while(($row = mysqli_fetch_assoc($result))){
    array_push($nuc,$row);   
}
//find most 3 recent temperature
$sql = "select temperature from patient_status where patient_ID = $targetID order by record_ID desc limit 3";
$result = $conn->query($sql);
$tem = [];
while(($row = mysqli_fetch_assoc($result))){
    array_push($tem,$row);   
}
//find treatment_area
$sql = "select treatment_area from patient where patient_ID = $targetID ";
$result = $conn->query($sql);
$tre = [];
while(($row = mysqli_fetch_assoc($result))){
    array_push($tre,$row);   
}
if(sizeof($nuc) != 2 ||sizeof($tem) != 3 || sizeof($tre) != 1){
    echo json_encode('not leave');
}
else if($nuc[0]['result'] =='negative' && $nuc[1]['result'] == 'negative' && (strtotime($nuc[0]['time']) - strtotime($nuc[1]['time']) >= 86400)&& $tre[0]['treatment_area'] == 'mild' && $tem[0]['temperature'] <37.3 && $tem[1]['temperature'] <37.3 && $tem[2]['temperature'] <37.3){
    //find doctor of mild area
    $sql = "select user_ID from user where type = 'doctor' and treatment_area = 'mild' ";
    $result = $conn->query($sql);
    $row = mysqli_fetch_assoc($result);
    $doctor_id_mild = $row['user_ID'];
    $sql = "insert into message (patient_ID, towards) values ($targetID,$doctor_id_mild) ";
    $result = $conn->query($sql);
    if(!$result){
        echo json_encode($sql);
        echo json_encode($nuc);
        echo json_encode($tem);
        echo json_encode($tre);
        echo json_encode($doctor_id_mild);
    }else{
        echo json_encode($sql);
    }
}else{
    echo json_encode(strtotime($nuc[0]['time']));
    echo json_encode("     ");
    echo json_encode(strtotime($nuc[1]['time']));
    echo json_encode($tre);
}


mysqli_close($conn);
?>