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
$name = $requests['name'];
$NACheck_result = $requests['NACheck_result'];
$NACheck_time = $requests['NACheck_time'];
$level = $requests['level'];
$NACheck_time=substr($NACheck_time,0,10)." ".substr($NACheck_time,11,8);

$sql =  "INSERT INTO patient ".
        "(name) ".
        "VALUES ".
        "('$name')";

$result = $conn->query($sql);

if(!$result){
    $msg=['success'=>'0'];
    echo json_encode($msg);
}
else {
    $sql =  "SELECT LAST_INSERT_ID() as lastID";
    $result = $conn->query($sql);
    $row = mysqli_fetch_assoc($result);
    $patient_ID=$row['lastID'];

    $sql =  "INSERT INTO nucleic_acid_testing_result ".
            "(patient_ID,recorder_ID,result,time,level) ".
            "VALUES ".
            "($patient_ID,$id,'$NACheck_result','$NACheck_time','$level')";


    $result = $conn->query($sql);

    $sql = "SELECT bed_ID FROM bed WHERE patient_ID IS NULL and duty_nurse_ID IS NOT NULL and treatment_area = '$level'";
    $result = $conn->query($sql);

    if($result->num_rows != 0){
        $row = mysqli_fetch_assoc($result);
        $bed_ID = $row['bed_ID'];
        $sql = "UPDATE bed set `patient_ID` = '$patient_ID' WHERE `bed_ID` = '$bed_ID'";
        $result = $conn->query($sql);
    }

    if(!$result){ 
        $msg=['success'=>$sql];
        echo json_encode($msg);
    }
    else {
        $msg=['success'=>'1'];
        echo json_encode($msg);
    }
}



mysqli_close($conn);
?>