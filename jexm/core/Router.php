<?php
	namespace jexm\core;

	/**
	* Router class prepares and extracts the URL requests and returns them for use in the application yes.
	* @package Jexm
	*/
	class Router{
		
		/**
		* @var object Class for userdefined routes
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
			
			BaseHelper::setRoute(array
				(
					"controller" => $this->controller,
					"method" => $this->method,
					"args" => $this->args
				));
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
		* Seeks userdefined routes first and if not found seeks for RESTful routing.
		*/
		protected function extractURL(){
			if(!$this->routes->routeMatches()){
				$this->controller = (!empty($this->requests[0])) ? ucfirst($this->requests[0]) : "";
				$this->method = (!empty($this->requests[1])) ? $this->requests[1] : "";
				$this->args = (count($this->requests) > 2) ? array_slice($this->requests,2) : array();
			}else{
				$this->getControllerFromRoutes();
			}
		
		}
		
		
		/**
		* Uses the userdefined routes.
		*/
		private function getControllerFromRoutes(){
			$routes = $this->routes->useRoute();
			$this->controller = $routes['controller'];
			$this->method = $routes['method'];
			$this->args = array();
		}
	}