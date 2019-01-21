<?php
require('ols_config.php');
session_start();

/*$results = $_POST['data'];
for($counter = 0; $counter < count($results); $counter++){
    echo $results[$counter]['qid'] . "";
}*/


//$_PUT = array();
$p = file_get_contents('php://input');
//echo $p;
$obj = json_decode($p, TRUE);
//echo $obj[1]['qid'];
$results_exam = array();
$sum = 0;
$cidval = '';
$uidval = '';
$question_count = count($obj);
$correctAnswer = 0;
for ( $counter = 0; $counter < count($obj); $counter++ ) {
    //echo 'q:';
    //echo $obj[$counter]['qid'];
    //echo 'option :';
    //echo $obj[$counter]['option'];
    $qid = $obj[$counter]['qid'];
    $selected = $obj[$counter]['option'];
    $uidval = $obj[$counter]['uid'];
    $cidval = $obj[$counter]['cid'];

    $sql = "SELECT count(qid) as correct FROM ols_question where qid='$qid' and solution='$selected'";
    $result = mysqli_query($con,$sql);
    while ($row = mysqli_fetch_array($result)) {
        $correct = $row['correct'];
        
        if ( $correct == 1 ) {
            $sum += 10;
            $correctAnswer += 1;
        }
        
        $results_exam[] = array("qid" => $qid, "correct" => $correct);
    }
    
}

$sql_insert = "INSERT into ols_user_attempt(aid, cid, uid,  score, correct_answer,total_question) VALUES (NULL, '$cidval','$uidval','$sum', '$correctAnswer','$question_count')";
$result_insert=mysqli_query($con,$sql_insert);
if(mysqli_affected_rows($con)>0){   
} else {
    $results_exam[] = array("error");
}


echo json_encode($results_exam);

//$data[] = array();
//$data = var_dump($obj);
//echo "TESTL";
//echo $data;
//echo $x['0'];
//$cid = $_POST['cid'];

/*$sql_question = "SELECT qid, qdesc, choice1, choice2, choice3, choice4, solution, uid, q_type from ols_question where cid=1 and q_status='A' ORDER BY RAND() LIMIT 5";
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
echo json_encode($question_arr);*/
?>


