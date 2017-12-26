<?php
ini_set('display_errors', 'On');  
error_reporting(E_ALL);
<<<<<<< HEAD

include 'operateTable.php';
=======
>>>>>>> 65b99929690d0d14f82079611c60c523e247c9ae

include 'operateTable.php';

$file_path = "dropTables1.sql";
if(file_exists($file_path)) {
	$fp = fopen($file_path, "r");
	$sql = fread($fp,filesize($file_path));
	//echo $str = str_replace("\r\n","<br />",$str);

	$object = new Operation($sql);
}
?>
