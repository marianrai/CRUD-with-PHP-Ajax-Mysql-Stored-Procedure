<?php

class TokenGenerator
{
	private $token;
	private $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
	private $randomString = '';

	public function __construct($length = 32)
	{
		if (!is_int($length)) {
			return null;
		}
		
    	$charactersLength = strlen($this->characters);
    	    	
    	for ($i = 0; $i < $length; $i++) {
        	$this->randomString .= $this->characters[mt_rand(0, $charactersLength - 1)];
    	}
    	
	}


	public function getCode()
	{		
		return trim($this->randomString);
	}


}