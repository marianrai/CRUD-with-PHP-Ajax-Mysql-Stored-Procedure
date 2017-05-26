<?php

class DB
{
	private $pdo;
	private $stmt;
	private $results = null;
	
	public function __construct()
	{
		$this->pdo = ConnectToDb::connect()->pdo;
	}


	public function runSqlQuery($sql)
	{
		$this->stmt = $this->pdo->prepare($sql);
		$this->stmt->execute();

		return $this;
	}


	public function getResults()
	{
		return $this->stmt->fetchAll();
	}
	
}