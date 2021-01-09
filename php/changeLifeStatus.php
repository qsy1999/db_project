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
$doctor_id = $requests['doctor_id'];
$type = $requests['type'];


$sql = "UPDATE bed SET patient_ID = NULL WHERE `patient_ID` = '$id'";
$result1 = $conn->query($sql);
$sql = "select patient_status.* from patient , patient_status where patient_status.patient_ID = patient.patient_ID and patient_status.record_ID = (select max(patient_status.record_ID) from patient_status where patient_status.patient_ID = patient.patient_ID)  and patient.patient_ID = '$id' limit 1 ";
$result2 = $conn->query($sql);
if(!$result2||!$result1){
    $msg=['success'=>'0'];
    echo json_encode($msg);
}else {
    $row = mysqli_fetch_assoc($result2);
    $v1=$row['result_ID'];
    $v2=$row['patient_ID'];
    $v3=$row['bed_ID'];
    if($v3=='')$v3="NULL";
    $v4=$row['temperature'];
    $v5=$row['symptom'];
    $v6=$row['time'];
    $sql = "insert into patient_status (result_ID,patient_ID,bed_ID,recorder_ID,temperature,symptom,life_status,time) values($v1,$v2,$v3,$doctor_id,'$v4','$v5','$type','$v6');" ;
    $result3 = $conn->query($sql);
    if(!$result3){
        $msg=['success'=>'0'];
        echo json_encode($sql);
    }
    else {
        
        
        
        $sql = "delete from message where patient_ID = $id";
        $result4 = $conn->query($sql);
        
        if(!$result4){
            $msg=['success'=>'0'];
            echo json_encode($sql);
        }else{
            $msg=['success'=>'1'];
            echo json_encode($msg);
        }
        
    }
   
}

mysqli_close($conn);
?>