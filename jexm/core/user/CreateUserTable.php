<?php
	namespace jexm\core\user;
	
	/**
	* Class creates a table for users.
	*/
	class CreateUserTable Extends \jexm\core\BaseModel{
		
		public function __construct(){
			parent::__construct();
			$this->create();
		}
		
		
		/**
		* Creates the usertable if not yet exists.
		*/
		private function create(){
			$table = "users";
			$cols = "
				id INT(11) AUTO_INCREMENT PRIMARY KEY,
				first_name VARCHAR(40),
				last_name VARCHAR(40),
				username VARCHAR(40),
				email VARCHAR(60) NOT NULL UNIQUE,
				password VARCHAR(128) NOT NULL UNIQUE,
				created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
				updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
				";
			$sql = "CREATE TABLE IF NOT EXISTS {$table} ({$cols})";
			$this->db->exec($sql);
		}
		
	}