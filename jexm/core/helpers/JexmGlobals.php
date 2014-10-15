<?php 
	namespace jexm\core\helpers;
	
	/**
	* Class for getting userinput
	* Class is being "aliased-in" into the controllers namespace as Globals.
	*/
	class JexmGlobals{
		
		
		/**
		* Returns all $_GET vars || null
		*/
		public static function getAll(){
			return (isset($_GET)) ? $_GET : null;
		}
		
		/**
		* Returns specific $_GET var || null
		*/
		public static function get($key){
			return (isset($_GET[$key])) ? $_GET[$key] : null;
		}
		
		/**
		* Returns all $_POST vars || null
		*/
		public static function postAll(){
			return (isset($_POST)) ? $_POST : null;
		}
		
		/**
		* Returns specific $_POST var || null
		*/
		public static function post($key){
			return (isset($_POST[$key])) ? $_POST[$key] : null;
		}
	}