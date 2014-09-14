<?php 
	namespace jexm\core\helpers;
	
	/**
	* Class for setting and getting sessiondata in Appcontrollers in runtime. 
	* Class is being "aliased-in" into the controllers namespace as Session.
	*/
	class JexmSession{
	
		public static function getUrlRequest(){
			return $_SESSION['CurrentRequest'];
		}
		
		
	}