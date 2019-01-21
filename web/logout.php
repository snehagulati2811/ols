<?php 
session_start();
session_unset();
            
session_destroy(); 
header("Location: /OLS/web/login.php");
?>