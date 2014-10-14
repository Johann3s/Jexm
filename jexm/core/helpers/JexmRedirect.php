<?php
	namespace jexm\core\helpers;
	
	/**
	* Class for handling redirects.
	* Class is being "aliased-in" into the controllers namespace as Redirect.
	*/
	class JexmRedirect{
		
		/**
		* @var object LinkClass
		*/
		protected $routes;
		
		
		public function __construct(){
			$this->routes = \jexm\core\route\Routes::getRoutesObject();
		}
		
		/**
		* Redirect internally
		*/
		public function to($redirection){
			$location = $this->routes->linkControllerRequest($redirection);
			$location = (URL_ROOT != '/') ? URL_ROOT . $location : $location;
			header("Location:" . $location);
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