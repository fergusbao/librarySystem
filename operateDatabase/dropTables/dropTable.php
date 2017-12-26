<?Php
	include "connectDatabase.php"; // database connection 

	$object = new Drop();

	class Drop {

		public function __construct() {
			$table = "DOCUMENT";
			$sql = "DROP TABLE $table; ";
        	self::dropTable($sql);
        }

		public function dropTable($sql) {
			$pdo = Database::connect();
			$launchcode = $pdo->prepare($sql);
			if($launchcode->execute()){
				echo "Table deleted\n";
			}
			else {
				print_r($launchcode->errorInfo() . "\n"); 
			}
		}
	}
?>