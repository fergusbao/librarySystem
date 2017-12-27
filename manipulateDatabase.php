
<?php
include 'connectDatabase.php';

if(1) {
	ini_set('display_errors', 'On');	// Debug
	error_reporting(E_ALL | E_STRICT);
}

class ManipulateDatabase {
	var $sql;
	public function __construct($sql) {
		$this->sql = $sql;
	}

	public function executeSQL() { // Execute SQL code and return table display html string
		$conn = Database::connect();
		if($conn){			
			$launchcode = $conn->prepare($sql);
			$launchcode->execute();
			$Result = $launchcode->fetchAll();
			return $Result;
		}
	}
}
?>

