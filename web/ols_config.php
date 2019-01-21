<?php
// Connection
$con = mysqli_connect("localhost", "root", "iphone123");
if (!$con) {
        die("Database connection failed: " . mysqli_connect_error());
    }

#connect to database

  $db_select = mysqli_select_db($con, "ols_db");
 
    if (!$db_select) {
        die("Database selection failed: " . mysqli_connect_error());
    }

    ignore_user_abort(true);
    set_time_limit(0);
?>
