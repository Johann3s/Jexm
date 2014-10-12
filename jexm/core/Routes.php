<?php
	namespace jexm\core;
	
	class Routes{
		
		/**
		* @var array Holds all userdefined routes
		*/
		protected $routes = array();
		
		/**
		* $var array Holds current request. 
		*/
		protected $currentRequest = array();
		
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
		* @return object Routes(self)
		*/
		public static function getRoutesObject(){
			if(!isset(self::$self)){
				self::$self = new Routes();
			}
			return self::$self;
		}
		
		
		
		/**
		* Sets a userdefined route.
		* @param string $url Route to be mapped
		* @param string $location A controller and optional method to direct to.
		*/
		public function set($url,$location){
			$this->routes[] = [$url,$location];
		}
		
		
		
		/**
		* Sets current URLRoutes
		* Populates the session with same value to help out with constructing links etc.
		* $param array $routes Associative array with controller,method and args request.
		* @return void
		*/
		public function saveURLRequest(array $routes){
			$this->currentRequest = $routes;
			$_SESSION['CurrentRequest'] = $routes;
		}
		
		
		
		/**
		* Gets all routes
		* @return array All userdefined routes
		*/
		public function get(){
			return $this->routes;
		}
		
		
		
		/**
		* Determines if route matches current URLRequest
		* Allows for following slash.
		* @return boolean True if a userdefined route is found.
		*/
		public function routeMatches(){
			if(empty($this->routes)){return false;}
			
			$urlRequest = BaseHelper::stripURLRequest();

			foreach($this->routes as $route){
				if($route[0] == $urlRequest || $route[0] . "/" == $urlRequest){
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
		* @return array Associative array with userdefined controller and method to execute
		*/
		public function useRoute(){
			$routeParts = explode("@", $this->matchingRoute[1]);
			
			//If a method has been declared the array has more than 1 index. Otherwise set method to "".
			$method = (count($routeParts) > 1) ? $routeParts[1] : "";
			return ["controller" => ucfirst($routeParts[0]), "method" => $method];
		}
		
		
		
		/**
		* Gets current URLRequest. Data is decided with regard of userdefined routes.
		*/
		public function getCurrentRequest(){
			return $this->currentRequest;
		}
	}