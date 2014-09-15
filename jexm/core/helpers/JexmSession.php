<?php 
	namespace jexm\core\helpers;
	
	/**
	* Class for setting and getting sessiondata in Appcontrollers in runtime. 
	* Class is being "aliased-in" into the controllers namespace as Session.
	*/
	class JexmSession{
		
		/**
		* Getter method for Current URLRequest
		*/
		public static function getUrlRequest(){
			return $_SESSION['CurrentRequest'];
		}
		
		/**
		* Getter method for controllerpart of URLRequest
		*/
		public static function getControllerRequest(){
			$request = self::getUrlRequest();
			return $request['controller'];
		}
		
		/**
		* Getter method for methodpart of URLRequest
		*/
		public static function getMethodRequest(){
			$request = self::getUrlRequest();
			return $request['method'];
		}
		
		
	}