<?php

class DB
{
	private $pdo;
	private $stmt;
	public $response = null;
	
	public function __construct()
	{
		$this->pdo = ConnectToDb::connect()->pdo;
	}


	public function runSqlQuery($sql, $bind = null)
	{
		try {

			$this->stmt = $this->pdo->prepare($sql);

			if (is_array($bind) && count($bind) > 0) {
				
				$this->response = $this->stmt->execute($bind);
				
			}
			else {

				$this->response = $this->stmt->execute();
				
			}
			

		} 
		catch(PDOException $e) {
			echo $e->getMessage();
			die();
		}

		return $this;
	}


	public function getResults()
	{
		return $this->stmt->fetchAll();
	}
	
}