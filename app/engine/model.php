<?php

class Model {
	protected $db;
	public function __construct() {
		
		$this->db = new DB(DB_TYPE, HOST, DB_USER, DB_PASS, DB_NAME);

	}
}