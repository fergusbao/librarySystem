// errorReport.php
// This php file helps us show the error reports.

<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
// Include the php file which has error
include("file_with_errors.php"); 
?>