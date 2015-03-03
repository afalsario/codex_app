<!DOCTYPE html>
<html>
<head>
	<title>Current List</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

	<?php


	// try {
	// 	//-------------1. Establish DB Connection
	// 	$dbc = new PDO('mysql:host=localhost;dbname=wp_codex_functions', 'root', 'root');

	// 	// Tell PDO to throw exceptions on error
	// 	$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


	// 	$sql = "CREATE TABLE functions (
	// 		id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	// 		function VARCHAR (30) NOT NULL,
	// 		definition VARCHAR(250) NOT NULL,
	// 		reg_date TIMESTAMP

	// 	)";

	// 	$dbc->exec($sql);
	// 	echo "Table functions created successfully.";
	// } catch(PDOEXCEPTION $e) {
	// 	echo $sql . "<br>" . $e->getMessage();
	// }

	// $dbc = null;

	for($i = 1; $i < 264; $i++){

		// This gets the contents of a page in the WP codex containing function references and definitions
		$thePage = file_get_contents('https://developer.wordpress.org/reference/functions/page/' . $i . '/');

		// This returns a text-only version of the page, similar to "View Source"
		$thePage = htmlspecialchars($thePage);

		// These lines will trim code before and after the block of content that contains terms and definitions
		$start = strpos($thePage, "article");
		$end = strpos($thePage, htmlspecialchars("<nav"));
		$newString = substr($thePage, $start, $end - $start );

		// Explodes the new trimmed string to isolate individual blocks of code for each WP function
		$stringArray = explode(htmlspecialchars('/">'), $newString);

		$number = count($stringArray);

		// Removes the first item in the array which contains excess code
		array_shift($stringArray);

			// From the array, pulling out function name and description
			foreach ($stringArray as $key => $value) {
				// These lines isolate the function name from the rest of the code
				$endPos = strpos($value, htmlspecialchars("<"));
				$functionName = substr($value, 0, $endPos - 0);

				// These lines isolate the definition from the rest of the code.
				$defStart = strpos($value, htmlspecialchars("</b>")) + 10;
				$defEnd = strpos($value, htmlspecialchars("</p>"));

				$definition = substr($value, $defStart, $defEnd - $defStart);

				$definition = htmlspecialchars_decode($definition);

				// try {	
				// 	//-------------1. Establish DB Connection
				// 	$dbc = new PDO('mysql:host=localhost;dbname=wp_codex_functions', 'root', 'root');

				// 	// Tell PDO to throw exceptions on error
				// 	$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


				// 	$stmt = $dbc->prepare("INSERT INTO Functions(function, definition)
				// 		VALUES (:function, :definition)");

				// 	$stmt->bindParam(':function', $functionName, PDO::PARAM_STR, 100);
				// 	$stmt->bindParam(':definition', $definition, PDO::PARAM_STR, 100);

				// 	if($stmt->execute())
				// 	{
				// 		echo "Success!!!";
				// 		$dbc= null;
				// 	}

				// } catch(PDOEXCEPTION $e) {
				// 	trigger_error("Error occured while trying to insert into the DB:" . $e->getMessage(), E_USER_ERROR);
				// }

				echo "<dt>" . $functionName . "</dt><br>";
				echo "<dd>" . htmlspecialchars_decode($definition) . "</dd><br>";
			}
	}
	?>
</body>
</html>
 

