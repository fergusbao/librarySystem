<?php
if(1) {
	ini_set('display_errors', 'On');	// Debug
	error_reporting(E_ALL | E_STRICT);
}

define("USERNAME", "jy394");
define("PASSWORD", "q6XVpDlL2");
define("DATABASESOFTWARE", "mysql");
define("HOSTWEBSITE", "sql.njit.edu");

class Database {
	private static $conn;
	// Set PDO object and Test connectivity
	public function __construct() {	
		try {
			// Create connection
			self::$conn = new PDO(DATABASESOFTWARE . ':host=' . HOSTWEBSITE .';dbname=' . USERNAME, USERNAME, PASSWORD);
			// Check connection
			// if (self::$conn->connect_error) {
// 				die("Connection failed: " . $conn->connect_error);
			// } 
			self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			echo "Connection Successful To Database\n";
		} 
		catch (PDOException $e) {
			//echo "Connection Error To Database: " . $e->getMessage() . "<hr>";
		}
	}

	public static function connect() { // check whether $conn has already instantiated
		if(!self::$conn) {
			new Database();
		}
		return self::$conn;
	}
}
?>
