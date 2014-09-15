<?php
	namespace jexm\core;

	/**
	* Router class prepares and extracts the URL requests and returns them for use in the application yes.
	* @package Jexm
	*/
	class Router{
		
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
		* Prepare URL request for extraction
		*/
		protected function prepareRequest(){
			//Remove eventual get-strings
			$urlRequest = preg_replace("/[?].+/","",$_SERVER['REQUEST_URI']);
			
			//If URL_ROOT is NOT set to / remove from request before extracting.
			$urlRequest = (URL_ROOT != "/") ? str_replace(URL_ROOT,"",$urlRequest) : $urlRequest;
			
			//Extract urlparts into array
			$this->requests = (!empty($urlRequest)) ? explode("/", trim($urlRequest, "/")) : null;
			
		}
		
		/**
		* Validate preparation and populate properties.
		*/
		protected function extractURL(){
			
			$this->controller = (!empty($this->requests[0])) ? ucfirst($this->requests[0]) : "";
			$this->method = (!empty($this->requests[1])) ? $this->requests[1] : "";
			$this->args = (count($this->requests) > 2) ? array_slice($this->requests,2) : array();
		
		}
	}