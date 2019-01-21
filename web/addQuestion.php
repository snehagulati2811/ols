<?php
require('ols_config.php');
session_start();

$quest_desc = $_POST['question'];
$choice1 = $_POST['choice1'];
$choice2 = $_POST['choice2'];
$choice3 = $_POST['choice3'];
$choice4 = $_POST['choice4'];
$answer = $_POST['solution'];
$uid = $_POST['uid'];
$cid = $_POST['cid'];
$qtype = $_POST['qtype'];

$sql = "INSERT into ols_question (qid,qdesc,choice1,choice2,choice3,choice4,solution,uid,cid,q_type,q_status) VALUES (NULL,'$quest_desc','$choice1','$choice2','$choice3','$choice4','$answer','$uid','$cid','$qtype', 'A')"; 
$result=mysqli_query($con,$sql);
if(mysqli_affected_rows($con)>0){ 
    $quest_arr=array();
    $quest_arr[] = array("uid" => $uid, "cid" => $cid );
}
echo json_encode($quest_arr);
?>
