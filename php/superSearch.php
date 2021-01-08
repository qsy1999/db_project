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
$sql = 'select patient.patient_ID, patient.name, patient.treatment_area from patient join nucleic_acid_testing_result where patient.patient_ID = nucleic_acid_testing_result.patient_ID and nucleic_acid_testing_result.result_ID = (select max(nucleic_acid_testing_result.result_ID) from nucleic_acid_testing_result where nucleic_acid_testing_result.patient_ID = patient.patient_ID) and nucleic_acid_testing_result.level = "mild"';

if($target == '0'){  
        if($special == '1'){
            $sql = 'select patient.patient_ID, patient.name, patient.treatment_area from patient join nucleic_acid_testing_result where patient.patient_ID = nucleic_acid_testing_result.patient_ID and nucleic_acid_testing_result.result_ID = (select max(nucleic_acid_testing_result.result_ID) from nucleic_acid_testing_result where nucleic_acid_testing_result.patient_ID = patient.patient_ID) and nucleic_acid_testing_result.level = "mild"';
        }
        if($special == '2'){
            $sql = 'select patient.patient_ID, patient.name, patient.treatment_area from patient join nucleic_acid_testing_result where patient.patient_ID = nucleic_acid_testing_result.patient_ID and nucleic_acid_testing_result.result_ID = (select max(nucleic_acid_testing_result.result_ID) from nucleic_acid_testing_result where nucleic_acid_testing_result.patient_ID = patient.patient_ID) and nucleic_acid_testing_result.level = "intense"';
        }
        if($special == '3'){
            $sql = 'select patient.patient_ID, patient.name, patient.treatment_area from patient join nucleic_acid_testing_result where patient.patient_ID = nucleic_acid_testing_result.patient_ID and nucleic_acid_testing_result.result_ID = (select max(nucleic_acid_testing_result.result_ID) from nucleic_acid_testing_result where nucleic_acid_testing_result.patient_ID = patient.patient_ID) and nucleic_acid_testing_result.level = "critical"';
        }
        if($special == '4'){
            $sql = 'select patient.patient_ID, patient.name, patient.treatment_area from patient join message where message.patient_ID = patient.patient_ID';
        }
        if($special == '5'){
            $sql = 'select patient.patient_ID, patient.name, patient.treatment_area from patient join message where patient.patient_ID not in (select patient.patient_ID from patient join message where message.patient_ID = patient.patient_ID)';
        }
        if($special == '6'){
            $sql = 'select patient.patient_ID, patient.name, patient.treatment_area from patient , patient_status, nucleic_acid_testing_result where patient_status.patient_ID = patient.patient_ID and patient_status.record_ID = (select max(patient_status.record_ID) from patient_status where patient_status.patient_ID = patient.patient_ID) and nucleic_acid_testing_result.result_ID = patient_status.result_ID and nucleic_acid_testing_result.level != patient.treatment_area';
        }
        if($special == '7'){
            $sql = 'select patient.patient_ID, patient.name, patient.treatment_area from patient , patient_status, nucleic_acid_testing_result where patient_status.patient_ID = patient.patient_ID and patient_status.record_ID = (select max(patient_status.record_ID) from patient_status where patient_status.patient_ID = patient.patient_ID) and nucleic_acid_testing_result.result_ID = patient_status.result_ID and nucleic_acid_testing_result.level = patient.treatment_area';
        }
        if($special == '8'){
            $sql = "select patient.patient_ID, patient.name, patient.treatment_area from patient , patient_status where patient_status.patient_ID = patient.patient_ID and patient_status.record_ID = (select max(patient_status.record_ID) from patient_status where patient_status.patient_ID = patient.patient_ID) and patient_status.life_status = 'discharged'";
        }
        if($special == '9'){
            $sql = "select patient.patient_ID, patient.name, patient.treatment_area from patient , patient_status where patient_status.patient_ID = patient.patient_ID and patient_status.record_ID = (select max(patient_status.record_ID) from patient_status where patient_status.patient_ID = patient.patient_ID) and patient_status.life_status = 'treating'";
        }
        if($special == '10'){
            $sql = "select patient.patient_ID, patient.name, patient.treatment_area from patient , patient_status where patient_status.patient_ID = patient.patient_ID and patient_status.record_ID = (select max(patient_status.record_ID) from patient_status where patient_status.patient_ID = patient.patient_ID) and patient_status.life_status = 'dead'";
        }
        if ($special == '0'){
            if($selector == '1'){
                $sql = "select  patient.patient_ID, patient.name, patient.treatment_area from patient where name = '$selector_value' ";
            }
            if($selector == '2'){
                $sql = "select  patient.patient_ID, patient.name, patient.treatment_area from patient where patient_ID = '$selector_value' ";
            }
            if($selector == '3'){
                $sql = "select  patient.patient_ID, patient.name, patient.treatment_area from patient natural join bed where bed.duty_nurse_ID = '$selector_value' ";
            }
        }  
    if($area == '1'){
        $sql .= "and patient.treatment_area = 'isolated area'";
    }
    if($area == '2'){
        $sql .= "and patient.treatment_area = 'mild'";
    }
    if($area == '3'){
        $sql .= "and patient.treatment_area = 'intense'";
    }
    if($area == '4'){
        $sql .= "and patient.treatment_area = 'critical'";
    }
}

else if($target = '1'){


}
$set = array();
$result = $conn->query($sql);

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