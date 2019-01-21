<?php
require('ols_config.php');
session_start();

$module_name = $_POST['mName'];
$cid = $_POST['sel_course'];

//$timestamp = date("Y-m-d H:i:s");
//$currentTime = date("Y-m-d H:i:s");

$sql = "INSERT into ols_module (mid,module,cid) VALUES (NULL, '$module_name','$cid')";
$result=mysqli_query($con,$sql);

$select_sql = "SELECT mid,module FROM ols_module where cid='$cid'";
//$result = 'Success';
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
