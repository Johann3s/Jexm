<?php
	namespace jexm\core;

	/**
	* Router class prepares and extracts the URL requests and returns them for use in the application.
	* @package Jexm
	*/
	class Router{
		
		/**
		* @var object Class for userdefined routes (Will hold other routes parsed from URLrequest, setter in this class)
		*/
		protected $routes;
		
		/**
		* @var array Holds prepared URL request
		*/
		private $requests = array();
		
		/**
		* @var string Holds eventual controller part of request
		*/
		private $controller;
		
		/**
		* @var string Holds eventual method part of request
		*/
		private $method;
		
		/**
		* @var array Holds eventual arguments of request
		*/
		private $args = array();
		
		
		public function __construct(\jexm\core\route\Routes $routes){
			$this->routes = $routes;
		}

		/**
		* Public handle to execute classmethods.
		* Populates class properties and sets the requested route.
		*/
		public function extractRoute(){
			$this->extractURL();
			$this->routes->setCurrentRequest([
					"controller" => $this->controller,
					"method" => $this->method,
					"args" => $this->args
				]);
		}
		
		
		
		/**
		* Validate preparation and populate properties.
		* Seeks userdefined routes
		*/
		protected function extractURL(){
			if($this->routes->routeMatches()){
				$this->useDataFromDefinedRoutes();
			}else{
				BaseHelper::send404();
			} 
		}
		
		
		
		/**
		* Uses the userdefined routes and preps properties.
		*/
		private function useDataFromDefinedRoutes(){
			$routes = $this->routes->useRoute();
			$this->controller = $routes['controller'];
			$this->method = $routes['method'];
			$this->args = $this->routes->getArgs();
		}
		
		
	}