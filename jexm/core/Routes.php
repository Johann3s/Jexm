<?php
	namespace jexm\core;
	
	class Routes{
		
		/**
		* @var array Holds all userdefined routes
		*/
		protected $routes = array();
		
		/**
		* $var array holds only matching route
		*/
		protected $matchingRoute = null;
		
		/**
		* @var object Holds itself,singleton.
		*/
		private static $self;
		
		/**
		* Singleton class
		*/
		public static function getRoutesObject(){
			if(!isset(self::$self)){
				self::$self = new Routes();
			}
			return self::$self;
		}
		
		/**
		* Sets a route
		*/
		public function set($url,$location){
			$this->routes[] = [$url,$location];
		}
		
		
		/**
		* Gets all routes
		*/
		public function get(){
			return $this->routes;
		}
		
		
		/**
		* Determines if route matches current URLRequest
		* Allows for following slash.
		*/
		public function routeMatches(){
			if(empty($this->routes)){return false;}
			
			//Remove eventual get-strings
			$urlRequest = preg_replace("/[?].+/","",$_SERVER['REQUEST_URI']);

			//If URL_ROOT is NOT set to / remove from request before extracting and append a slash.
			$requestURI = (URL_ROOT != "/") ? "/" . str_replace(URL_ROOT,"",$urlRequest) : $urlRequest;

			foreach($this->routes as $route){
				if($route[0] == $requestURI || $route[0] . "/" == $requestURI){
					$this->matchingRoute = $route;
					return true;
					break;
				}
			}
			$this->matchingRoute = array();
			return false;
		}
		
		/**
		* Prepares and returns a matching route.
		*/
		public function useRoute(){
			$routeParts = explode("@", $this->matchingRoute[1]);
			//If a method has been declared the array has more than 1 index. Otherwise set method to "".
			$method = (count($routeParts) > 1) ? $routeParts[1] : "";
			return ["controller" => ucfirst($routeParts[0]), "method" => $method];
		}
	}