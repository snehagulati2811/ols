<?php
require('ols_config.php');
session_start();

$cid = $_POST['cid'];
//$cid = $_POST['cid'];

$sql_question = "SELECT qid, qdesc, choice1, choice2, choice3, choice4, solution, uid, q_type from ols_question where cid='$cid' and q_status='A' ORDER BY RAND() LIMIT 5";
$result = mysqli_query($con,$sql_question);

$question_arr = array();
while ($row = mysqli_fetch_array($result)) {
    $qid= $row['qid'];
    $qdesc = $row['qdesc'];
    $choice1 = $row['choice1'];
    $choice2 = $row['choice2'];
    $choice3 = $row['choice3'];
    $choice4 = $row['choice4'];
    $solution = $row['solution'];
    $uid = $row['uid'];
    $qtype = $row['q_type'];

    $question_arr[] = array("qid" => $qid, "qdesc" => $qdesc, "choice1" => $choice1, "choice2" => $choice2, "choice3" => $choice3, "choice4" => $choice4, "solution" => $solution, "uid" => $uid, "qtype" => $qtype);
    
}
echo json_encode($question_arr);
?>


