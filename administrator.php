<!doctype html>

<html lang="en">
<head>
	<meta charset="utf-8">
	<title>The City Library System<center></center>></title>
	<meta name="description" content="Library System">
  	<meta name="author" content="Junyi Ye">
	<link rel="stylesheet" href="css/styles.css?v=1.0">
</head>
<body>
	<h1>This is the Administrator's page!!!</h1>

	<?php
		include "connectDatabase.php";

		if(1) {
			ini_set('display_errors', 'On');	// Debug
			error_reporting(E_ALL | E_STRICT);
		}

		$object = new Main();

		class Main {
			
			public function __construct() {
				$sql = "SELECT * FROM DOCUMENT";
				print_r(self::executeSQL($sql));
			}

			public function executeSQL($sql) { // Execute SQL code and return table display html string
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
</body>
</html>

