<?php

require_once 'inc/bootstrap.php';


$output = '';


if ( isset($_POST['action']) && isset($_POST['token']) && ($_POST['token'] === $_SESSION['token'])) {
	
	$db = new DB();

	$procedure = "
		CREATE PROCEDURE selectUser()
		BEGIN
			SELECT * FROM users ORDER BY created_at ASC;
		END;
	";

	// drop procedure if exists
	$stmt = $db->runSqlQuery("DROP PROCEDURE IF EXISTS selectUser");
	if ($stmt) {
		
		// create procedure
		$stmt = $db->runSqlQuery($procedure);		
		if ($stmt) {

			// call the procedure
			$stmt = $db->runSqlQuery("CALL selectUser()");

			// get all the users
			$users = $stmt->getResults();

			// display users in a table
			$output = HtmlOutput::displayInTable($users);
			
		}
		else {
			$output = 'PROCEDURE failed!';
		}

	}
	else {
		$output = 'DROP failed!';
	}

	




}
else {
	$output = '<h2>Direct access to this page is not allowed!</h2>';
}

echo $output;