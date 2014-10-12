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
		
		
		public function __construct(){
			$this->routes = Routes::getRoutesObject();
		}

		
		/**
		* Public handle to execute classmethods.
		* Populates class properties and sets the requested route.
		*/
		public function extractRoute(){
		
			$this->prepareRequest();
			$this->extractURL();
			
			$this->routes->saveURLRequest([
					"controller" => $this->controller,
					"method" => $this->method,
					"args" => $this->args
				]);
		}
		
		
		
		/**
		* Prepare URL request for extraction.
		* Clean from getstrings and/or eventual reduntant folderpaths
		* Extract routeparts from URLRequest.
		*/
		protected function prepareRequest(){
			$urlRequest = BaseHelper::stripURLRequest();
			$this->requests = (!empty($urlRequest)) ? explode("/", trim($urlRequest, "/")) : null;
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
				exit;
			} 
		}
		
		
		/**
		* Uses the userdefined routes.
		*/
		private function useDataFromDefinedRoutes(){
			$routes = $this->routes->useRoute();
			$this->controller = $routes['controller'];
			$this->method = $routes['method'];
			$this->args = array();
		}
		
		
	}