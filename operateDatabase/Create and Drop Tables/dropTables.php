<?php
ini_set('display_errors', 'On');  
error_reporting(E_ALL);

include 'operateTable.php';

$file_path = "dropTables.sql";
if(file_exists($file_path)) {
	$fp = fopen($file_path, "r");
	$sql = fread($fp,filesize($file_path));

	new Operation($sql);
}
?>
