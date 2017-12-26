<?php
	include 'connectDatabase.php';

	class Create {
		
		public function __construct($sql) {	
        	self::createTable($sql);
        }

		public function createTable($sql) {
			//$conn;
			try {
			     $conn = Database::connect();
			     $conn->exec($sql);
			     echo ("Created Table.\n");

			} catch(PDOException $e) {
				print_r($conn->errorInfo());
				//echo "Error creating table: " . $conn->errorInfo() . "\n";
			    //echo $e->getMessage();//Remove or change message in production code
			}
		}
	}
?>