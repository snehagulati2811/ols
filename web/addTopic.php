<?php
require('ols_config.php');
session_start();
$tName = $_POST['tName'];
$cid = $_POST['sel_course'];
$mid = $_POST['sel_module'];

//$timestamp = date("Y-m-d H:i:s");
//$currentTime = date("Y-m-d H:i:s");

$sql = "INSERT into ols_topic(tid, topic, cid,  mid) VALUES (NULL, '$tName','$cid','$mid')";
$result=mysqli_query($con,$sql);
//$topic_arr = array();
//if(mysqli_affected_rows($con)>0){ 
    
  //  $topic_arr[] = array("tid" => $tid, "topic" => $topic );
//}
//echo json_encode($topic_arr);
//$select_sql = "SELECT tid, topic, course, module FROM ols_topic tp, ols_course co, ols_module mo where tp.cid=$cid and tp.mid=$mid and tp.cid=co.cid and tp.mid=mo.mid";
//$select_sql = "SELECT tid, topic FROM ols_topic where cid='$cid' and mid='$mid'";
//$ret_result = mysqli_query($con, $select_sql);
//$topic_arr = array();

//while( $row = mysqli_fetch_array($ret_result) ){ 
  //  $tid = $row['tid'];
   // $topic = $row['topic'];
//    $course = $row['course'];
//    $module = $row['module'];

    //$topic_arr[] = array("tid" => $tid, "topic" => $topic, "course" => $course, "module" => $module, "cid" => $cid, "mid" => $mid ); //a[5] = ['a','b','c','d','e'];
   // $topic_arr[] = array("tid" => $tid, "topic" => $topic ); //a[5] = ['a','b','c','d','e'];
//}

// encoding array to json format
//echo json_encode($topic_arr); // return a;

?>
