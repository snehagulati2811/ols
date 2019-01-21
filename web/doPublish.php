<?php
require('ols_config.php');
session_start();

$uid = $_POST['uid'];
$cid = $_POST['cid'];


$sql = "INSERT into ols_publish_exam (pid,uid,cid,p_status) VALUES (NULL,'$uid','$cid', 'A')"; 
$result=mysqli_query($con,$sql);
if(mysqli_affected_rows($con)>0){ 
    $quest_arr=array();
    $quest_arr[] = array("uid" => $uid, "cid" => $cid );
}
echo json_encode($quest_arr);
?>