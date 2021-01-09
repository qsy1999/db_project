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

$to = $requests['to'];
$sql = "select distinct patient.patient_ID, patient.name, patient.treatment_area from patient , patient_status, nucleic_acid_testing_result where patient_status.patient_ID = patient.patient_ID and patient_status.record_ID = (select max(patient_status.record_ID) from patient_status where patient_status.patient_ID = patient.patient_ID) and nucleic_acid_testing_result.result_ID = patient_status.result_ID and nucleic_acid_testing_result.level != patient.treatment_area and patient.treatment_area != 'isolated area' and nucleic_acid_testing_result.level = '$to'";
$result = $conn->query($sql);
if($result->num_rows == 0){
    $msg=['stop'=>1];
    echo json_encode($msg);
}
else{
    $row = mysqli_fetch_assoc($result);
    $id = $row['patient_ID'];
    $newTo = $row['treatment_area'];
    $sql = "SELECT bed_ID FROM bed WHERE patient_ID IS NULL and duty_nurse_ID IS NOT NULL and treatment_area = '$to'";
    $result = $conn->query($sql);
    if($result->num_rows == 0){
        $msg=['stop'=>1];
        echo json_encode($msg);
    }else{
        $row = mysqli_fetch_assoc($result);
        $bed_ID = $row['bed_ID'];
        $sql = "UPDATE bed set `patient_ID` = NULL WHERE `patient_ID` =  $id";
        $result = $conn->query($sql);
        $sql = "UPDATE patient set `treatment_area` = '$to' WHERE `patient_ID` = $id";
        $result = $conn->query($sql);
        $sql = "UPDATE bed set `patient_ID` = $id WHERE `bed_ID` = $bed_ID";
        $result = $conn->query($sql);

        $msg=['stop'=>0,'newTo'=>$newTo];
        echo json_encode($msg);
    }

}
   
mysqli_close($conn);
?>