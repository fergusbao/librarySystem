<?php
	include 'operateTable.php';

    
	$file_path = "createTables.sql";
	if(file_exists($file_path)) {
		$fp = fopen($file_path, "r");
		$sql = fread($fp,filesize($file_path));
		//echo $str = str_replace("\r\n","<br />",$str);

		$object = new Create($sql);
	}
?>