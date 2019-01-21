<?php
require('ols_config.php');
$uid = $_POST['uid'];
//$sql_course = "SELECT cid, course FROM ols_course where uid=$uid";
$sql_course = "SELECT reg.cid as coid, co.course cocourse, reg.regid registerID from ols_user_register reg, ols_course co where reg.uid=$uid and reg.cid = co.cid";
$course_result = mysqli_query($con,$sql_course);
$view_arr = array();

while( $row = mysqli_fetch_array($course_result) ){ 
    $cid = $row['coid'];
    $course = $row['cocourse'];
    $regid = $row['registerID'];

    $sql_module = "SELECT mid, module FROM ols_module where cid=$cid";
    $module_result = mysqli_query($con, $sql_module);
    while ($row = mysqli_fetch_array($module_result)) {
        $mid = $row['mid'];
        $module = $row['module'];
        $sql_topic = "SELECT tid, topic, name FROM ols_topic where cid=$cid and mid=$mid";
        $topic_result = mysqli_query($con, $sql_topic);

        while ($row = mysqli_fetch_array($topic_result)) {
            $tid = $row['tid'];
            $topic = $row['topic'];
            $name = $row['name'];

            $view_arr[] = array("cid" => $cid, "course" => $course, "mid" => $mid, "module" => $module, "tid" => $tid, "topic" => $topic, "name" => $name, "regid" => $regid);
        }
    }


    //$courses_arr[] = array("cid" => $cid, "course" => $course); //a[5] = ['a','b','c','d','e'];
}

// encoding array to json format
echo json_encode($view_arr); // return a;

?>
