<?php
require('ols_config.php');
if(isset($_GET['tid'])) {
// if id is set then get the file with the id from database
$tid    = $_GET['tid'];
$sql = "SELECT name, type, size, content " . "FROM OLS_TOPIC WHERE tid = '$tid'";
$result = mysqli_query($con,$sql) or die('Error, query failed');

list($name, $type, $size, $content) =  mysqli_fetch_array($result);
header("Content-length: $size");
header("Content-type: $type");
header("Content-Disposition: attachment; filename=$name");
echo $content;
exit;
}
?>
