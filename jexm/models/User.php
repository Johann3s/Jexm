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
		public function create(array $userData){
			
			if(empty($userData['password']) || empty($userData['email'])){
				throw new \Exception("Email and password are required for a user");
			}
			
			$comparison = array_intersect_key($userData,$this->userTableData);
			$this->userTableData = array_merge($this->userTableData,$comparison);
			
			$this->userTableData['password'] = \Hasher::create($this->userTableData['password']);
			
			$sql = "INSERT INTO users (first_name,last_name,username,email,password) VALUES (?,?,?,?,?)";
			$params = array_values($this->userTableData);
			
			return $this->insert($sql,$params);
		}
		
		/**
		* Gets user credentials for authentication
		*/
		public function getCredentials($email){
			return $this->fetch("SELECT id,email,password FROM users WHERE email = ? LIMIT 1",[$email]);
		}
	}