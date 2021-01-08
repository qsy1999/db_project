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