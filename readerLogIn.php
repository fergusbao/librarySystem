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
<?php
// define variable readerID and set to empty values
$readerID = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $readerID = test_input($_POST["readerID"]);
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<br>
<br>
<br>
<br>
<center><h1>The City Library System</h1></center>
<br>
<center><h2 style="color: #ff0000">Welcome Reader!</h2></center>
<br>
<br>
<center><p1 style="font-size: 30px">Log In</p1><center>
<br>
<br>
<br>

<form method="post" action="<?php echo 
htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
	ReaderID: <input type="text" name="readerID">
	<input type="submit">
</form>

<?php
echo $readerID
?>

</body>
</html>