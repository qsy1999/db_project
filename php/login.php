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

$user_ID = $requests['user_ID'];
$password = $requests['password'];

$sql = "SELECT * FROM user WHERE `user_ID` = '$user_ID'and `password` = '$password'";
$result = $conn->query($sql);

if($result->num_rows == 0){
    $msg=['login'=>'0'];
    echo json_encode($msg);
}else{    
    $row = mysqli_fetch_assoc($result);
    //'doctor', 'chief nurse', 'emergency nurse', 'hospital nurse'
    switch ($row['type']){
        case 'doctor':
            $getWorkArea = "SELECT type FROM treatment_area WHERE `doctor_ID` = '$user_ID'";
            $workArea = $conn->query($getWorkArea);
            $workArea = mysqli_fetch_assoc($workArea);

            $msg = ['login'=>'1','name'=>$row['name'],'type'=>$row['type'],'area'=>$workArea['type']];
            echo json_encode($msg);
            break;
        case 'chief nurse':
            $getWorkArea = "SELECT type FROM treatment_area WHERE `chief_nurse_ID` = '$user_ID'";
            $workArea = $conn->query($getWorkArea);
            $workArea = mysqli_fetch_assoc($workArea);
            $msg = ['login'=>'1','name'=>$row['name'],'type'=>$row['type'],'area'=>$workArea['type']];
            echo json_encode($msg);
            break;
        case 'hospital nurse':
            $getWorkArea = "SELECT treatment_area FROM bed WHERE `duty_nurse_ID` = '$user_ID'";
            $workArea = $conn->query($getWorkArea);
            $workArea = mysqli_fetch_assoc($workArea);
            $msg = ['login'=>'1','name'=>$row['name'],'type'=>$row['type'],'area'=>$workArea['treatment_area']];
            echo json_encode($msg);
            break;
        case 'emergency nurse':
            $msg = ['login'=>'1','name'=>$row['name'],'type'=>$row['type'],'area'=>'0'];
            echo json_encode($msg);
            break;


    }
    
    
    
}



mysqli_close($conn);
?>