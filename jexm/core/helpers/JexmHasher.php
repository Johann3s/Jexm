<?php
	namespace jexm\core\helpers;
	
	/**
	* Class for hashing strings. 
	*/
	
	class JexmHasher{
		
		
		/**
		* Hashformat for blowfish
		* Cost and iterations
		*/
		private static $hashFormat = "$2y$10$";

		
		/**
		* Creates hash from string.
		* @param string String to be hashed
		* @return string Hashed string
		*/
		public static function create($hashMe){
			return (!empty($hashMe)) ? self::hashData($hashMe) : false;
		}
		
		
		/**
		* Hashes and salts string
		* @param string String to be hashed
		* @return Hashed and salted string
		*/
		private static function hashData($stringToHash){
			$salt = self::generateSalt();
			$formatAndSalt = self::$hashFormat . $salt;
			return crypt($stringToHash,$formatAndSalt);
		}
		
		
		/**
		* Generates a random salt with 22 chars.
		* @return string Random string with 22 chars.
		*/
		private static function generateSalt(){
			$generate = md5(uniqid('',true));
			return substr($generate,0,22);
		}
	}