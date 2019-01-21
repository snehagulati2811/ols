<?php
require('ols_config.php');

$uid = $_POST['uid'];


$sql_course = "SELECT cid, course FROM ols_course where uid='$uid'";

$course_results = mysqli_query($con, $sql_course);
$qid_arr = array();

while($row = mysqli_fetch_array($course_results)) {
    $cid = $row['cid'];
    $course = $row['course'];
    $sql = "SELECT count(qid) as total from ols_question where uid='$uid' and cid='$cid'" ;
    $result = mysqli_query($con,$sql);
    //$qid_arr = array(); // char a[5] = null;
    while($row = mysqli_fetch_array($result)) {
        $total = $row['total'];

        $sql_publish = "SELECT count(pid) as ptotal, p_status from ols_publish_exam where uid='$uid' and cid='$cid'";
        $ptotal ='0';
        $p_status ='D';
        $result_publish = mysqli_query($con, $sql_publish);
        while($row = mysqli_fetch_array($result_publish)) {
            $ptotal = $row['ptotal'];
            $p_status = $row['p_status']; 
        }
        $qid_arr[] = array("total" => $total, "cid" => $cid, "course" => $course, "ptotal" => $ptotal, "p_status" => $p_status);
    }
}


// encoding array to json format
echo json_encode($qid_arr); // return a;

?>
