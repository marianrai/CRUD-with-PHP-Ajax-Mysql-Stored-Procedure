<?php

/**
* Connect to a database using the singleton pattern
*/

class ConnectToDb
{
	/**
	*	this property holds the class number of instantiations
	* 	@var integer
	*/
	private static $instance = null;

	/**
	*	this property holds the PDO object
	*	@var PDO Object
	*/
	public $pdo;


	/**
	*	Make the constructor private to avoid outside instantiation
	* 	this will create a database connection using PDO
	*/
	private function __construct()
	{
		// always use try catch blocks when working with pdo
		// otherwise, in case of an error, 
		// the database connection details, including the username and password
		// will be visible to any user
		try {
			$this->pdo = new PDO(DB_DRIVER, DB_USER, DB_PASS);
		} catch (PDOException $e) {
			echo 'There was an error with the database: '. $e->getMessage();
			die();
		}
	}


	/**
	* 	Make the magic method 'clone' private, to avoid clonning
	*/
	private function __clone()
	{

	}


	/**
	*	return the $instance if any or instantiate the class
	*/
	public static function connect()
	{
		if (!isset(self::$instance)) {
			self::$instance = new self;
		}
		return self::$instance;
	}


}