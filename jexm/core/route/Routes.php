<?php
	namespace jexm\core\route;
	use \jexm\core\BaseHelper as BaseHelper;
	
	class Routes{
		
		/**
		* @var array Holds all userdefined routes
		*/
		protected $allRoutes = array();
		
		/**
		* $var Obj Holds current request. 
		*/
		protected $currentRequest;
		
		/**
		* $var obj Holds only matching route
		*/
		protected $matchingRoute;
		
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
				self::$self = new \jexm\core\route\Routes();
			}
			return self::$self;
		}
		
		
		
		/**
		* Sets a userdefined route.
		* @param string $url Route to be mapped
		* @param string $location A controller and optional method to direct to.
		* @param string $reqMethod REQUEST_METHOD (POST || GET) 
		*/
		private function set($url,$location,$reqMethod){
			$this->allRoutes[] = new JexmRoute($url,$location,$reqMethod);
		}
		
		public function post($url,$location){
			$this->set($url,$location,'POST');
		}
		
		public function get($url,$location){
			$this->set($url,$location,'GET');
		}
		
		
		/**
		* Sets current URLRoutes
		* Populates the session with same value to help out with constructing links etc.
		* $param array $routes Associative array with controller,method and args request.
		* @return void
		*/
		public function saveURLRequest(array $parsedRequest){
			$this->currentRequest = new CurrentRequest($parsedRequest);
			$_SESSION['CurrentRequest'] = $parsedRequest;
		}
		
		
		
		
		
		/**
		* Determines if route matches current URLRequest
		* Allows for following slash.
		* IF an argument has been defined in route 'firstPart' will hold a value and be compared with instead of full url.
		* @return boolean True if a userdefined route is found.
		*/
		public function routeMatches(){
			if(empty($this->allRoutes)){return false;}
			
			$urlRequest = BaseHelper::stripURLRequest();

			foreach($this->allRoutes as $route){
			
				//Parts prevents buggy behavior if argument is requested (/params/name) and preceeded with another route (/params).
				$firstPart = ($route->hasParam) ? BaseHelper::getEverythingButLastPartOfUrl() : "";
				$lastPart = BaseHelper::getLastPartOfUrl();
				
				//Runs if no argument has been declared
				if($route->url == $urlRequest && $route->requestMethod == $_SERVER['REQUEST_METHOD'] && !($route->hasParam)){
					$this->matchingRoute = $route;
					return true;
					break;
				}
				//Runs if argument has been declared
				if($route->url == $firstPart && $route->requestMethod == $_SERVER['REQUEST_METHOD'] && !empty($firstPart)){
					$this->matchingRoute = $route;
					return true;
					break;
				}
				
			}
			$this->matchingRoute = null;
			return false;
		}
		
		
		
		/**
		* Prepares and returns a matching route.
		* @return array Associative array with userdefined controller and method to execute
		*/
		public function useRoute(){
			$routeParts = explode("@", $this->matchingRoute->location);
			
			//If a method has been declared the array has more than 1 index. Otherwise set method to "".
			$method = (count($routeParts) > 1) ? $routeParts[1] : "";
			return ["controller" => ucfirst($routeParts[0]), "method" => $method];
		}
		
		
		/**
		* Determines if a parameter has been within current route.
		* If so returns that argument as an associative array with named parameter as key and last part of url as value
		* @return array
		*/
		public function getArgs(){
			if(!$this->matchingRoute->hasParam){
				return array();
			}
			$param = \jexm\core\BaseHelper::getLastPartOfUrl();
			return [$this->matchingRoute->paramName => $param];
		}
		
		
		/**
		* Gets current URLRequest. Data is decided with regard of userdefined routes.
		* @return object Current request including requestmethod.
		*/
		public function getCurrentRequest(){
			return $this->currentRequest;
		}
	}