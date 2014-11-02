<?php 
	namespace jexm\core\helpers;
	
	/**
	* Class for setting and getting sessiondata in Appcontrollers in runtime. 
	*/
	class JexmSession{
		
		
		/**
		* @var string Holds idxreference
		*/
		private $idxName;
		
		public function __construct(){
			$this->idxName = 'jexmSess';
		}
		
		
		/**
		* Adds data to session.
		* @param array $data Must be associative array
		*/
		public function add(array $data){
			if(count($data) < 1){
				throw new \Exception('Invalid array length. Must contain data.');
			}
			foreach($data as $key => $val){
				$_SESSION[$this->idxName][$key] = $val;
			}
		}
		
		
		/**
		* Removes chosen idx from session
		* @var string
		*/
		public function remove($string){
			if(isset($_SESSION[$this->idxName][$string])){
				unset($_SESSION[$this->idxName][$string]);
			}
		}
		
		
		
		/**
		* Kills whole session
		*/
		public function kill(){
			$_SESSION = array();
		}
		
		
		/**
		* Gets chosen idx from session
		* @var string
		* @return data from chosen idx
		*/
		public function get($string){
			if(isset($_SESSION[$this->idxName][$string])){
				return $_SESSION[$this->idxName][$string];
			}
			return null;
		}		
		
	}