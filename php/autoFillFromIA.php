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

$debug = [];

$sql = "select distinct patient.patient_ID, patient.name, patient.treatment_area from patient , patient_status, nucleic_acid_testing_result where patient_status.patient_ID = patient.patient_ID and patient_status.record_ID = (select max(patient_status.record_ID) from patient_status where patient_status.patient_ID = patient.patient_ID) and nucleic_acid_testing_result.result_ID = patient_status.result_ID and nucleic_acid_testing_result.level != patient.treatment_area and patient.treatment_area = 'isolated area'";
$result = $conn->query($sql);
while(($row = mysqli_fetch_assoc($result))){
    $id = $row['patient_ID'];
    $sql = "select level from nucleic_acid_testing_result where patient_ID = $id";
    $result2 = $conn->query($sql);
    $row2 = mysqli_fetch_assoc($result2);
    $to = $row2['level'];
    $sql = "select bed_ID from bed where treatment_area = '$to' and patient_ID is null and duty_nurse_ID is not null";
    $result3 = $conn->query($sql);
    if($result3->num_rows != 0){
        $row3 = mysqli_fetch_assoc($result3);
        $bed_ID = $row3['bed_ID'];

        $sql = "UPDATE patient set `treatment_area` = '$to' WHERE `patient_ID` = $id";
        $result4 = $conn->query($sql);
        $sql = "UPDATE bed set `patient_ID` = $id WHERE `bed_ID` = $bed_ID";
        $result5 = $conn->query($sql);
 
        $sql = "select user_ID from user where type = 'chief nurse' and treatment_area = '$to' ";
        $result6 = $conn->query($sql);
        $row6 = mysqli_fetch_assoc($result6);
        $chief_ID = $row6['user_ID'];
        $sql = "insert into message (patient_ID, towards) values ($id,$chief_ID) ";
        $result7 = $conn->query($sql);

    }
    array_push($debug,$sql);
}

echo json_encode($debug);
mysqli_close($conn);
?>