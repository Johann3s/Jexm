<?php
	namespace jexm\models;
	
	class User extends \jexm\core\BaseModel{
		
		protected $userTableData = [
			"firstname" => "", 
			"lastname" => "",
			"username" => "", 
			"email" => null, 
			"password" => null
		];
		
		public function __construct(){
			parent::__construct();
		}
		
		
		/**
		* Inserts a user to database.
		* @param array Associative array that needs to match property "userTableData" (otherwise value from property will be used, i.e null).
		*/
		public function insertUser(array $userData){
			$comparison = array_intersect_key($userData,$this->userTableData);
			$this->userTableData = array_merge($this->userTableData,$comparison);
			
			$sql = "INSERT INTO users (first_name,last_name,username,email,password) VALUES (?,?,?,?,?)";
			$params = array_values($this->userTableData);
			
			return $this->insert($sql,$params);
		}
		
	}