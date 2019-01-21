<?php
require('ols_config.php');
session_start();
$uid = $_POST['uid'];
//$mid = $_POST['sel_module'];


$select_reg_course = "SELECT oc.course as course, oc.cid as cid, ou.uid as uid, ou.user_name as username, ou.first_name fname, ou.last_name as lname from ols_course oc, ols_user_register our,ols_user ou  where oc.uid='$uid' and oc.cid=our.cid and our.uid=ou.uid";
$reg_course = mysqli_query($con,$select_reg_course);
$report_arr = array();
while( $row = mysqli_fetch_array($reg_course) ) { 
    
    $course = $row['course'];
    $repuid = $row['uid'];
    $cid = $row['cid'];
    //$score = $row['score'];
    //$repuid = $row['uid'];
    $username = $row['username'];
    $fname = $row['fname'];
    $lname = $row['lname'];
    $score = '';
    $correctAnswer = '';
    $totalQuestion = '';
    //$correctAnswer = $row['correct_answer'];
    //$totalQuestion = $row['total_question'];

    $select_report = "SELECT score, correct_answer, total_question FROM ols_user_attempt where uid='$repuid' and cid='$cid'";
    $reg_report = mysqli_query($con,$select_report);
    while ($row = mysqli_fetch_array($reg_report)) {
        $score = $row['score'];
        $correctAnswer = $row['correct_answer'];
        $totalQuestion = $row['total_question'];

    }
    $report_arr[] = array("course" => $course, "score" => $score, "repuid" => $repuid ,"course" => $course, "username" => $username, "fname" => $fname, "lname" => $lname, "correctAnswer" => $correctAnswer, "totalQuestion" => $totalQuestion); //a[5] = ['a','b','c','d','e'];
    //$course = $row['course'];
    //$score = $row['score'];
    //$repuid = $row['uid'];
    //$username = $row['username'];
    //$fname = $row['fname'];
    //$lname = $row['lname'];
    //$correctAnswer = $row['correct_answer'];
    //$totalQuestion = $row['total_question'];
}





//$select_records = "select co.course as course, OUA.score as score, OUA.uid as uid, OU.user_name as username, OU.first_name fname, OU.last_name as lname, OUA.correct_answer as correct_answer, OUA.total_question as total_question from ols_course co, ols_user_attempt OUA, ols_user OU  where co.uid='$uid' and co.cid=OUA.cid and OUA.uid=OU.uid";

//$select_sql = "SELECT tp.tid, tp.topic, tp.name, co.course, mo.module  FROM ols_topic tp, ols_course co, ols_module mo where tp.cid='$cid' and tp.mid='$mid' and tp.cid=co.cid and tp.mid=mo.mid";

//$rec_results = mysqli_query($con,$select_records);
//$report_arr = array();

/*while( $row = mysqli_fetch_array($rec_results) ){ 
    $course = $row['course'];
    $score = $row['score'];
    $repuid = $row['uid'];
    $username = $row['username'];
    $fname = $row['fname'];
    $lname = $row['lname'];
    $correctAnswer = $row['correct_answer'];
    $totalQuestion = $row['total_question'];
   
    $report_arr[] = array("course" => $course, "score" => $score, "repuid" => $repuid ,"course" => $course, "username" => $username, "fname" => $fname, "lname" => $lname, "correctAnswer" => $correctAnswer, "totalQuestion" => $totalQuestion); //a[5] = ['a','b','c','d','e'];
}*/

// encoding array to json format
echo json_encode($report_arr); // return a;

?>
