<?php
require('ols_config.php');
session_start();

$uid = $_POST['uid'];
//$cid = $_POST['cid'];
$sql_user_register = "SELECT count(cid) as regcount from ols_course where uid='$uid'";
$result_user_register= mysqli_query($con,$sql_user_register);
$ret_arr = array();

while ($row = mysqli_fetch_array($result_user_register)) {
    $regcount = $row['regcount'];
    $ret_arr[] = array("regcount"=> $regcount);
}

echo json_encode($ret_arr);
?>