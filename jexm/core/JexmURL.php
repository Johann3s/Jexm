<?php
	namespace jexm\core;
	
	/**
	* Class for handling URLrelated tasks. Class is being "aliased-in" into the controllers namespace as URL.
	*/
	class JexmURL{
		
		public static function getCurrentRequest(){
			return $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		}
		
	}