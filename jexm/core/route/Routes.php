<?php
	namespace jexm\core\route;
	use \jexm\core\BaseHelper as BaseHelper;
	use \jexm\core\helpers\JexmURL as URL;
	
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
		* @var object URL instance
		*/
		private $url;
		
		private function __construct(\jexm\core\helpers\JexmURL $url){
			$this->url = $url;
		}

		
		/**
		* Singleton class
		* @return object Routes(self)
		*/
		public static function getInstance(\jexm\core\helpers\JexmURL $url){
			if(!isset(self::$self)){
				self::$self = new \jexm\core\route\Routes($url);
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
			//validate routeformat
			$valid = explode("@",$location);
			if(count($valid) != 2){ throw new \Exception("Trying to save invalid route format"); }
			
			$this->allRoutes[] = \Route::set($url,$location,$reqMethod);
		}
		
		public function post($url,$location){
			$this->set($url,$location,'POST');
		}
		
		public function get($url,$location){
			$this->set($url,$location,'GET');
		}
		
		public function getAllRoutes(){
			return $this->allRoutes;
		}
		
		
		public function routeMatches(){
			 $matchingRoute = \RouteMatcher::matchRouteAndUrl();
			 $this->matchingRoute = (is_object($matchingRoute)) ? $matchingRoute : null;
			 return (is_object($matchingRoute)) ? true : false;
		}
		
		
		/**
		* Prepares and returns a matching route.
		* @return array Associative array with userdefined controller and method to execute
		*/
		public function useRoute(){
			$routeParts = explode("@", $this->matchingRoute->location);
			return ["controller" => ucfirst($routeParts[0]), "method" => $routeParts[1]];
		}
		
		
		/**
		* Returns requested param as an object with named parameter as property and last part of url as propvalue
		* @return object
		*/
		public function getArgs(){
			return $this->matchingRoute->getParam($this->url->getLastPartOfUrl());
		}
		
		
		
		/**
		* Sets current URLRrequest parsed into controller, method and args.
		* $param array $parsedRequest Associative array with controller,method and args request.
		* @return void
		*/
		public function setCurrentRequest(array $parsedRequest){
			$this->currentRequest = \CurrentRequest::set($parsedRequest); 
		}
		
		
		/**
		* Gets current URLRequest.
		* @return object Current request including requestmethod.
		*/
		public function getCurrentRequest(){
			return $this->currentRequest;
		}
		
		
		/**
		* Check if a route location matches a link
		* @param string $link Coming from JexmLink::create()
		*/
		public function matchLinkAndRoute($linkpath){
			return \RouteMatcher::matchRouteAndLink($linkpath);
			
		}
		
		
	}