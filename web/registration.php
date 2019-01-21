<?php
require('ols_config.php');

$user_name = $_POST['userName'];
$fName = $_POST['fName'];
$lName = $_POST['lName'];
$dob = $_POST['dob'];
$email = $_POST['email'];
$psw = $_POST['psw'];
$gender = $_POST['gender'];
$sel_role = $_POST['sel_role'];
//$timestamp = date("Y-m-d H:i:s");
//$currentTime = date("Y-m-d H:i:s");

$sql = "INSERT into ols_user (uid,user_name,first_name,last_name,gender,email,dob,registration_date,rid,timestamp,password) VALUES (NULL, '$user_name','$fName','$lName','$gender','$email', null, null, '$sel_role', null, '$psw')";
$result=mysqli_query($con,$sql);

$select_sql = "SELECT uid,user_name,first_name,last_name,gender,email,rid FROM ols_user where user_name='$user_name'";
//$result = 'Success';
$ret_result = mysqli_query($con,$select_sql);
$user_profile_arr = array();

while( $row = mysqli_fetch_array($ret_result) ){ 
    $uid = $row['uid'];
    $user_name = $row['user_name'];
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    $gender = $row['gender'];
    $email = $row['email'];
    $rid = $row['rid'];

    $user_profile_arr[] = array("uid" => $uid, "user_name" => $user_name, "first_name" => $first_name, "gender" => $gender, "email" => $email, "rid" => $rid); //a[5] = ['a','b','c','d','e'];
}

// encoding array to json format
echo json_encode($user_profile_arr); // return a;

?>
