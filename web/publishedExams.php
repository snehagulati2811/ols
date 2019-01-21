<?php
require('ols_config.php');
session_start();

$uid = $_POST['uid'];
//$cid = $_POST['cid'];

$sql_register = "SELECT our.cid as courseid from ols_user_register our, ols_publish_exam ope where  our.uid='$uid' and our.cid=ope.cid";
$result_register = mysqli_query($con,$sql_register);
$ret_arr = array();
while ($row = mysqli_fetch_array($result_register)) {

    $courseId = $row['courseid'];
   
    $sql_course = "SELECT course from ols_course where cid='$courseId'";
    $result_course = mysqli_query($con,$sql_course);

    while ($row = mysqli_fetch_array($result_course)) {
        
        $course = $row['course'];
        $attemptcount = 0;
        $scoreval = 0;
        

        $sql_attempt = "SELECT count(aid) as attemptcount, cid, uid, score, correct_answer, total_question from ols_user_attempt where uid=$uid and cid=$courseId";
        $result_attempt = mysqli_query($con,$sql_attempt);

        while($row = mysqli_fetch_array($result_attempt)) {
            $attemptcount = $row['attemptcount'];
            $scoreval = $row['score'];
            $correctAnswer = $row['correct_answer'];
            $totalQuestion = $row['total_question'];
           
        }

        $ret_arr[] = array("cid"=> $courseId, "course" => $course, "attempt" => $attemptcount, "score" => $scoreval, "correctAnswer" => $correctAnswer, "totalQuestion" => $totalQuestion );

    }
}
echo json_encode($ret_arr);
?>