<?php
require('ols_config.php');
$uid = $_POST['uid'];
$select_sql = "SELECT cid, course FROM ols_course where uid=$uid";

$ret_result = mysqli_query($con,$select_sql);
$courses_arr = array();

while( $row = mysqli_fetch_array($ret_result) ){ 
    $cid = $row['cid'];
    $course = $row['course'];
    $courses_arr[] = array("cid" => $cid, "course" => $course); //a[5] = ['a','b','c','d','e'];
}

// encoding array to json format
echo json_encode($courses_arr); // return a;

?>
