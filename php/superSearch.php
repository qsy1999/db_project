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
$area = $requests['area'];
$special = $requests['special'];
$selector = $requests['selector'];
$selector_value = $requests['selector_value'];

$select = 'select *';
$from = 'from';
$where = 'where';

if($target == '0'){
    if($area == '0'){
        if ($special == '0'){
            $sql = 'select patient.patient_ID, patient.name, bed.treatment_area from patient natural join bed join nucleic_acid_testing_result where patient.patient_ID = nucleic_acid_testing_result.patient_ID and nucleic_acid_testing_result.result_ID = (select max(nucleic_acid_testing_result.result_ID) from nucleic_acid_testing_result where nucleic_acid_testing_result.patient_ID = patient.patient_ID);';
        }
        if($special == '1'){
            $sql = 'select patient.patient_ID, patient.name, bed.treatment_area from patient natural join bed join nucleic_acid_testing_result where patient.patient_ID = nucleic_acid_testing_result.patient_ID and nucleic_acid_testing_result.result_ID = (select max(nucleic_acid_testing_result.result_ID) from nucleic_acid_testing_result where nucleic_acid_testing_result.patient_ID = patient.patient_ID) and nucleic_acid_testing_result.level = "mild";';
        }
        if($special == '2'){
            $sql = 'select patient.patient_ID, patient.name, bed.treatment_area from patient natural join bed join nucleic_acid_testing_result where patient.patient_ID = nucleic_acid_testing_result.patient_ID and nucleic_acid_testing_result.result_ID = (select max(nucleic_acid_testing_result.result_ID) from nucleic_acid_testing_result where nucleic_acid_testing_result.patient_ID = patient.patient_ID) and nucleic_acid_testing_result.level = "intense";';
        }
        if($special == '3'){
            $sql = 'select patient.patient_ID, patient.name, bed.treatment_area from patient natural join bed join nucleic_acid_testing_result where patient.patient_ID = nucleic_acid_testing_result.patient_ID and nucleic_acid_testing_result.result_ID = (select max(nucleic_acid_testing_result.result_ID) from nucleic_acid_testing_result where nucleic_acid_testing_result.patient_ID = patient.patient_ID) and nucleic_acid_testing_result.level = "critical";';
        }
        if($special == '4'){
            $sql = 'select patient.patient_ID, patient.name, bed.treatment_area from patient natural join bed join message where message.patient_ID = patient.patient_ID;';
        }
        if($special == '5'){
            $sql = 'select patient.patient_ID, patient.name, bed.treatment_area from patient natural join bed join message where patient.patient_ID not in (select patient.patient_ID from patient natural join bed join message where message.patient_ID = patient.patient_ID);';
        }
        if($special == '6'){

        }
        if($special == '7'){

        }
        if($special == '8'){

        }
        if($special == '9'){

        }
        if($special == '10'){
            
        }

    }
}
target 0 area 0 special 0;
select patient_ID, name, treatment_area from patient natural join bed
target 0 area 0 special 1;
select patient_ID, name, treatment_area from patient natural join bed where bed.treatment_area = mild
target 0 area 0 special 2;
select patient_ID, name, treatment_area from patient natural join bed where bed.treatment_area = intense
target 0 area 0 special 3;
select patient_ID, name, treatment_area from patient natural join bed where bed.treatment_area = critical
target 0 area 0 special 4;
select patient_ID, name, treatment_area from patient natural join bed where bed.treatment_area = mild and select
target 0 area 0 special 5;
target 0 area 0 special 6;
target 0 area 0 special 7;
target 0 area 0 special 8;
target 0 area 0 special 9;
target 0 area 0 special 10;

target 0 area 1 special 0;
target 0 area 1 special 1;
target 0 area 1 special 2;
target 0 area 1 special 3;
target 0 area 1 special 4;
target 0 area 1 special 5;
target 0 area 1 special 6;
target 0 area 1 special 7;
target 0 area 1 special 8;
target 0 area 1 special 9;
target 0 area 1 special 10;

target 0 area 2 special 0;
target 0 area 2 special 1;
target 0 area 2 special 2;
target 0 area 2 special 3;
target 0 area 2 special 4;
target 0 area 2 special 5;
target 0 area 2 special 6;
target 0 area 2 special 7;
target 0 area 2 special 8;
target 0 area 2 special 9;
target 0 area 2 special 10;

target 0 area 3 special 0;
target 0 area 3 special 1;
target 0 area 3 special 2;
target 0 area 3 special 3;
target 0 area 3 special 4;
target 0 area 3 special 5;
target 0 area 3 special 6;
target 0 area 3 special 7;
target 0 area 3 special 8;
target 0 area 3 special 9;
target 0 area 3 special 10;

target 0 area 4 special 0;
target 0 area 4 special 1;
target 0 area 4 special 2;
target 0 area 4 special 3;
target 0 area 4 special 4;
target 0 area 4 special 5;
target 0 area 4 special 6;
target 0 area 4 special 7;
target 0 area 4 special 8;
target 0 area 4 special 9;
target 0 area 4 special 10;


$result = $conn->query($sql);

if(!$result){
    $msg=['success'=>'0'];
    echo json_encode($msg);
}
else {
    $msg=['success'=>'1'];
    echo json_encode($msg);
}
   
mysqli_close($conn);
?>