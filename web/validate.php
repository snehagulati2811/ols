<?php
require('ols_config.php');
session_start();
$user_name = $_POST['userName'];
$psw = $_POST['psw'];


$select_sql = "SELECT COUNT(uid) as userId, uid, rid FROM ols_user where user_name='$user_name' and password='$psw'";

//$result = 'Success';
$ret_result = mysqli_query($con,$select_sql);
$user_arr = array();
$role ='';
while( $row = mysqli_fetch_array($ret_result) ){ 
    $userId = $row['userId'];
    $uid = $row['uid'];
    $rid = $row['rid'];
    
    $select_role = "SELECT role from ols_role where rid='$rid'";
    $role_result = mysqli_query($con, $select_role);
    while( $row = mysqli_fetch_array($role_result) ) {
    $role     = $row['role'];
    }
    $user_arr[] = array("count" => $userId, "uid" => $uid ,"rid" => $rid, "role" => $role); //a[5] = ['a','b','c','d','e'];
    // Set session variables
    $_SESSION["userRole"] = $rid;
    $_SESSION["descRole"] = $role;
    //$_SESSION["favanimal"] = $rid;
}






// encoding array to json format
echo json_encode($user_arr); // return a;

?>
