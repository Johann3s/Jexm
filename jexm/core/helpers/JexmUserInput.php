<?php 
	namespace jexm\core\helpers;
	
	/**
	* Class for getting userinput
	* Class is being "aliased-in" into the controllers namespace as Input.
	*/
	class JexmUserInput{
		
		/**
		* Returns all userinput
		*/
		public static function getAll(){
			return (isset($_GET)) ? $_GET : $_POST;
		}
		
		/**
		* Returns specific input
		*/
		public static function get($key){
			return (isset($_GET[$key])) ? $_GET[$key] : $_POST[$key];
		}
		
	}