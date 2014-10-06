<?php
	namespace jexm\core\helpers;
	
	/**
	* Class for authentication
	*/
	use \jexm\models\User as User;
	
	class JexmAuthentication{
		
		/**
		* @var object Usermodel
		*/
		protected $user;
		
		public function __construct(){
			$this->user = new User();
		}
		
		
		
		/**
		* Attempts to login user via email and password
		* @param string $email Email
		* @param string $password Unhashed password coming from user
		* @return boolean || int False if unsuccesful and userid if succesful
		*/
		public function login($email,$password){
			$credentials = $this->user->getCredentials($email);
			return (!empty($credentials) && crypt($password,$credentials[0]->password) === $credentials[0]->password) ? $this->doLoginUser($credentials) : false;
		}
		
		
		
		/**
		* Logs in user. Populates session
		* @return userid
		*/
		private function doLoginUser($credentials){
			$_SESSION['jexm_user']['id'] = $credentials[0]->id;
			$_SESSION['jexm_user']['authenticated'] = true;
			return $credentials[0]->id;
		}
		
		
		
		/**
		* Checks if user is logged in.
		* @return boolean || int False if not logged in and userid if logged in.
		*/
		public function authenticate(){
			return (!isset($_SESSION['jexm_user']) || !$_SESSION['jexm_user']['authenticated']) ? false : $_SESSION['jexm_user']['id'];
		}
		
		
		
	}