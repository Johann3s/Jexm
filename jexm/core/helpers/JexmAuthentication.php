<?php
	namespace jexm\core\helpers;
	use \jexm\core\facades\Session as Session;
	use \jexm\core\facades\User as User;
	/**
	* Class for authentication
	*/
	
	class JexmAuthentication{
		
		
		/**
		* Attempts to login user.
		* @param array Associative array with [column name => credentials of unhashed accessor,[columnname => unhashed password coming from user] 
		* @return boolean || int False if unsuccesful and userid if succesful
		*/
		public function login(array $columnsAndValues){
			if(count($columnsAndValues) != 2){
				throw new \Exception("Incorrect number of arguments given. Expecting exactly 2.");
			}
			
			
			$chunk = array_chunk($columnsAndValues,1,true); //split array two two arrays each [tablename => value]
			$accessorData = $chunk[0];
			$passwordData = $chunk[1];
			
			$credentials = User::getCredentials($accessorData); //Fetch credentials from model (must be usermodel)$this->user->
			
			$passwordValue = array_values($passwordData);
			$passwordColName = array_keys($passwordData);
			return (!empty($credentials) && crypt($passwordValue[0],$credentials[0]->$passwordColName[0]) === $credentials[0]->$passwordColName[0]) ? $this->doLoginUser($credentials) : false;
		}
		
		
		
		/**
		* Logs in user. Populates session
		* @return userid
		*/
		private function doLoginUser($credentials){
			Session::add(['jexmUserId' => $credentials[0]->id,'authenticated' => true]);
			return $credentials[0]->id;
		}
		
		
		
		/**
		* Checks if user is logged in.
		* @return boolean || int False if not logged in and userid if logged in.
		*/
		public function check(){
			$auth = Session::get('authenticated');
			return ($auth == true) ? Session::get('jexmUserId') : false;
		}
		
		/**
		* Logs out user
		*/
		public function logout(){
			Session::kill();
		}
		
		
		
	}