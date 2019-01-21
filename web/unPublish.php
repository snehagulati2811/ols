<?php
require('ols_config.php');
session_start();

$uid = $_POST['uid'];
$cid = $_POST['cid'];


$sql = "DELETE FROM ols_publish_exam where cid='$cid' and uid='$uid'"; 
$result=mysqli_query($con,$sql);
if(mysqli_affected_rows($con)>0){ 
    $quest_arr=array();
    $quest_arr[] = array("uid" => $uid, "cid" => $cid );
}
echo json_encode($quest_arr);
?>