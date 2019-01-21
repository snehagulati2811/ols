<?php
require('ols_config.php');
session_start();

$sql = "SELECT rid,role FROM ols_role";

$result = mysqli_query($con,$sql);

$role_arr = array(); // char a[5] = null;

while( $row = mysqli_fetch_array($result) ){ 
    $rid = $row['rid'];
    $role = $row['role'];
   
    $role_arr[] = array("rid" => $rid, "role" => $role);
}

// encoding array to json format
echo json_encode($role_arr); // return a;

?>
