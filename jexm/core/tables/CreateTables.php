<?php
	namespace jexm\core\tables;
	
	/**
	* Class creates a table for users.
	*/
	class CreateTables Extends \jexm\core\BaseModel{
		
		public function __construct(){
			parent::__construct();
		}
		
		
		/**
		* Creates the usertable if not yet exists.
		*/
		public function createUserTable(){
			$table = "users";
			$sql = "CREATE TABLE IF NOT EXISTS {$table} ({$this->getCols()})";
			$this->db->exec($sql);
		}
		
		
		/**
		* Sqlite syntax needs to be tweaked a bit. Include sqlquery in regard of which driver is chosen.
		*/
		private function getCols(){
			$settings = include(ROOT."config".DS."database.php");
			return ($settings['driver'] == "sqlite") ? $this->getSqliteQuery() : $this->getMysqlQuery();
		}
		
		
		private function getMysqlQuery(){
			return 
			"id INT(11) AUTO_INCREMENT PRIMARY KEY,
			first_name VARCHAR(40),
			last_name VARCHAR(40),
			username VARCHAR(40),
			email VARCHAR(60) NOT NULL UNIQUE,
			password VARCHAR(128) NOT NULL UNIQUE,
			created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
			updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP";
		}
		
		
		private function getSqliteQuery(){
			return 
			"id INTEGER PRIMARY KEY AUTOINCREMENT,
			first_name VARCHAR(40),
			last_name VARCHAR(40),
			username VARCHAR(40),
			email VARCHAR(60) NOT NULL UNIQUE,
			password VARCHAR(128) NOT NULL UNIQUE,
			created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP";			
		}
		
	}