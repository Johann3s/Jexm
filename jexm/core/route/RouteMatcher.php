<?php
	namespace jexm\core\route;		
	use \jexm\core\helpers\JexmURL as URL;
	use \jexm\core\BaseHelper as BaseHelper;
			
	class RouteMatcher{	
		
		
		public function __construct(\jexm\core\route\Routes $routesInstance){
			$this->allRoutes = $routesInstance->getAllRoutes();
		}
		
		
		/**
		* Determines if route matches current URLRequest
		* Allows for following slash.
		* IF an argument has been defined in route 'firstPart' will hold a value and be compared with instead of full url.
		* @return boolean True if a userdefined route is found.
		*/
		public function matchRouteAndUrl(){
			if(empty($this->allRoutes)){return false;}

			foreach($this->allRoutes as $route){
			
				//Parts prevents buggy behavior if argument is requested (/params/name) and preceeded with another route (/params).
				$firstPart = ($route->hasParam) ? URL::getEverythingButLastPartOfUrl() : "";
				$lastPart = URL::getLastPartOfUrl();
				
				//Runs if no argument has been declared
				if($route->url == URL::stripURLRequest() && $route->requestMethod == $_SERVER['REQUEST_METHOD'] && !($route->hasParam)){
					return $route;
				}
				//Runs if argument has been declared
				if($route->url == $firstPart && $route->requestMethod == $_SERVER['REQUEST_METHOD'] && !empty($firstPart)){
					return $route;
				}
			}
			return false;
		}
		
		
		/**
		* Determines if a link contains a controller@method request. If so return that location.
		* Otherwise return as is.
		* @return string
		*/
		public function matchRouteAndLink($linkpath){
			$isMailLink = (strpos($linkpath,"@") == true && strpos($linkpath,"mailto") == false) ? false : true;
			foreach($this->allRoutes as $route){
				if($linkpath == $route->location){
					return $route->url;
				}
			} 
			if(!$isMailLink){
				BaseHelper::kill("Unable to resolve matching route from link. Please check that route exists.");
			}
			return $linkpath;		
		}
	}