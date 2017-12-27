<?php
if(1) {
	ini_set('display_errors', 'On');	// Debug
	error_reporting(E_ALL | E_STRICT);
}

include "../../connectDatabase.php";

$table = "LIBRARY_READER";
$fileName = $table . ".csv";
$file = fopen($fileName, "r");
$attr = array(); // $attr[0], $attr[1], $attr[2], $attr[3]...
$val = array(); // $:val0, :val1, :val2, :val3...
$array = array(); // store the value of every tuple
$counter = 0;

while(!feof($file)) {
	foreach (fgetcsv($file) as $key => $value) {
		$attr[$key] = $value;
	}
	break;
}

$attrList = "";
$valList = "";
$numAttr = count($attr);

for ($i=0; $i < $numAttr; $i++) {
	if ($i != $numAttr-1) {
		$attrList .= "$attr[$i]" . ", ";
		$valList .= ":val" . $i . ", ";
		$val[$i] = ":val" . $i;
	}
	else {
		$attrList .= "$attr[$i]";
		$valList .= ":val" . $i;
		$val[$i] = ":val" . $i;
	}
}

// $sql = "INSERT INTO $table($attr[0], $attr[1], $attr[2], $attr[3]) VALUES (:val0, :val1, :val2, :val3)";
$sql = "INSERT INTO $table ($attrList) VALUES ($valList); ";
//echo $sql;

$pdo = Database::connect();
//Prepare our statement.
$statement = $pdo->prepare($sql);

while(!feof($file)) {		

	if ($counter === 0) {
		// do nothing
		//echo "do nothing";
		//break;
	}
	else {
		foreach (fgetcsv($file) as $key => $value) {
				$array[$key] = $value;
		}
		// //Bind our values to our parameters.
		for ($i=0; $i < $numAttr; $i++) { 
			$statement->bindValue($val[$i], $array[$i]);
			//echo $val[$i] . ", " . $array[$i] . "\n";
		}

		if ($statement->execute()) {
			echo "Row inserted!\n";
		}
		else {
			print_r($statement->errorInfo());
			echo "\n"; 
		}
	}
	$counter += 1;
}

fclose($file);
?>
