<?php
require('ols_config.php');

$tid = $_POST['tid'];
$topic = $_POST['topic'];

//$timestamp = date("Y-m-d H:i:s");
//$currentTime = date("Y-m-d H:i:s");

$sql = "DELETE FROM ols_topic where tid='$tid'";
$result=mysqli_query($con,$sql);

$select_sql = "SELECT tid,topic FROM ols_topic where tid='$tid'";
//$result = 'Success';
$ret_result = mysqli_query($con,$select_sql);
$topic_arr = array();

while( $row = mysqli_fetch_array($ret_result) ){ 
    $tid = $row['tid'];
    $topic = $row['topic'];

    $topic_arr[] = array("tid" => $tid, "topic" => $topic); //a[5] = ['a','b','c','d','e'];
}

// encoding array to json format
echo json_encode($topic_arr); // return a;

?>
