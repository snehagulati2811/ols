<?php
require('ols_config.php');
$cid = $_POST['cid'];
$select_sql = "SELECT mid, module FROM ols_module where cid=$cid";

$ret_result = mysqli_query($con,$select_sql);
$module_arr = array();

while( $row = mysqli_fetch_array($ret_result) ){ 
    $mid = $row['mid'];
    $module = $row['module'];
    $module_arr[] = array("mid" => $mid, "module" => $module); //a[5] = ['a','b','c','d','e'];
}

// encoding array to json format
echo json_encode($module_arr); // return a;

?>
