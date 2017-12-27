<?php

include '../connectDatabase.php';

class Operation {
	
	public function __construct($sql) {	
    	self::operateTable($sql);
    }

	public function operateTable($sql) {
		try {
		     $conn = Database::connect();
		     $conn->exec($sql);
		     echo ("Operation successed!\n");

		} catch(PDOException $e) {
			print_r($conn->errorInfo());
		}
	}
}
?>