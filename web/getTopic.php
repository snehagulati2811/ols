<?php
require('ols_config.php');
session_start();
$cid = $_POST['sel_course'];
$mid = $_POST['sel_module'];

$select_sql = "SELECT tp.tid, tp.topic, tp.name, co.course, mo.module  FROM ols_topic tp, ols_course co, ols_module mo where tp.cid='$cid' and tp.mid='$mid' and tp.cid=co.cid and tp.mid=mo.mid";

$ret_result = mysqli_query($con,$select_sql);
$topic_arr = array();

while( $row = mysqli_fetch_array($ret_result) ){ 
    $tid = $row['tid'];
    $topic = $row['topic'];
    $name = $row['name'];
    $course = $row['course'];
    $module = $row['module'];
    $topic_arr[] = array("tid" => $tid, "topic" => $topic, "name" => $name ,"course" => $course, "module" => $module, "cid" => $cid, "mid" => $mid); //a[5] = ['a','b','c','d','e'];
}

// encoding array to json format
echo json_encode($topic_arr); // return a;

?>
