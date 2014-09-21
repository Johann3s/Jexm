<?php
	namespace jexm\core\helpers;
	
	/**
	* Class for handling URLrelated tasks. Class is being "aliased-in" into the controllers namespace as URL.
	*/
	class JexmURL{
		
		/**
		* Returns current full URL
		*/
		public static function getCurrentURLString(){
			return $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		}
		
		/**
		* Returns only requested path (without eventual querystrings)
		*/
		public static function getCurrentURLWithoutQueryString(){
			if(isset($_SERVER['REDIRECT_QUERY_STRING'])){
				return str_replace("?".$_SERVER['REDIRECT_QUERY_STRING'],"",$_SERVER['REQUEST_URI']);
			}
			return $_SERVER['REQUEST_URI'];
		}
		
	}