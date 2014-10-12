<?php
	namespace jexm\core\helpers;
	
	/**
	* Class for handling redirects.
	* Class is being "aliased-in" into the controllers namespace as Redirect.
	*/
	class JexmRedirect{
		
		/**
		* Redirect internally
		*/
		public function to($redirection){
			header("Location:" . URL_ROOT . $redirection);
			exit;
		}
		
		/**
		* Redirect externally (out from site)
		*/
		public function out($redirection){
			header("Location:" . $redirection);
			exit;
		}
	}