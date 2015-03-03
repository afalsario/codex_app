<?php
try {
	//-------------1. Establish DB Connection
	$dbc = new PDO('mysql:host=localhost;dbname=wp_codex_functions', 'root', 'root');

	// Tell PDO to throw exceptions on error
	$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$array = $dbc->query("SELECT id, function, definition FROM functions")->fetchAll(PDO::FETCH_ASSOC);

	echo json_encode($array);

} catch(PDOEXCEPTION $e) {
	echo $sql . "<br>" . $e->getMessage();
}