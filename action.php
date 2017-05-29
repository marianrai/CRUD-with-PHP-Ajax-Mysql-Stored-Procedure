<?php

require_once 'inc/bootstrap.php';


$output = '';


if ( isset($_POST['action']) && isset($_POST['token']) && ($_POST['token'] === $_SESSION['token'])) {
	
	$db = new DB();

	// INSERT
	if ($_POST['action'] === 'insert') {
		$first_name = strip_tags(trim($_POST['firstName']));
		$last_name = strip_tags(trim($_POST['lastName']));
		
		$procedure = "
			CREATE PROCEDURE insertUser(IN firstName varchar(150), lastName varchar(150))
			BEGIN
			INSERT INTO users(first_name, last_name) VALUES (firstName, lastName);
			END
		";

		// drop procedure if exists
		$stmt = $db->runSqlQuery("DROP PROCEDURE IF EXISTS insertUser");
		if ($stmt->response) {

			// create the procedure
			$stmt = $db->runSqlQuery($procedure);
			if ($stmt->response) {

				// call the procedure with placeholders and pass an array
				// that will be used in execute() function
				// to bind the parameters
				$stmt = $db->runSqlQuery("CALL insertUser(?, ?)", [$first_name, $last_name]);

				if ($stmt->response) {
					$output = '{"success":"The user has been inserted."}';
				}
				else {
					$output = '{"error":"The user has NOT been inserted. Please try again."}';
				}

			}
			else {
				$output = '{"error":"PROCEDURE failed!"}';
			}

		}
		else {
			$output = '{"error":"DROP failed!"}';
		}

	}

}




else {
	$output = '<h2>Direct access to this page is not allowed!</h2>';
}



echo $output;