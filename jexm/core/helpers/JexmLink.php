<?php
	namespace jexm\core\helpers;
	
	/**
	* Class to be used in templates for handling linkrelated tasks.
	*/
	class JexmLink{
		
		/**
		* @var Css class given to current page in breadcrumbs
		*/
		private $cssClass = "crumbs-current-url";
		
		/**
		* @var object Routes instance
		*/
		private $routes;
		
		
		/**
		* @var object URL instance
		*/
		private $url;
		
		
		/**
		* Path created in links. Useful for some other classes
		*/
		private $path;
		
		public function __construct(\jexm\core\route\Routes $routes, \jexm\core\helpers\JexmURL $url){
			$this->routes = $routes;
			$this->url = $url;
		}
		
		/**
		* Creates an a element.
		* @var string $path href-attribute
		* @var string $text Text to be displayed
		* @var array $params Optional getparams (requires assocative array)
		* @return mixed <a> element
		*/
		public function create($path, $text, $params = array()){
		
			//Checks if given path is a controller request or regular path. Returns either as it were or with the url specified in matching route.
			$path = $this->routes->matchLinkAndRoute($path);
			$path = (!empty($params)) ? $path . "?" .$this->buildQueryString($params) : $path;
			$path = (URL_ROOT != '/') ? URL_ROOT . $path : $path;
			//Saving premarkup path. Useful for other classes.
			$this->path = $path;
			return "<a href='{$path}'>{$text}</a>"; 
		}
		
		
		/**
		* Automates creation of pagination links.
		*/
		public function paginate($path, $text, array $params){
			$path = $path . "?" . $this->buildQueryString($params);
			return "<a href='{$path}'>{$text}</a>"; 
		}
		
		
		/**
		* Builds querystrings.
		*/
		private function buildQueryString(array $params){
			$queryString = "";
			$end = 0;
			foreach($params as $get => $value){
				$end++;
				$queryString .= $get . "=" . $value;
				$queryString .= ($end == count($params)) ? "" : "&amp;"; //If multiple querystrings exist build them up with ampersand
			}
			return $queryString;
		}

		
		/**
		* Creates and returns simple breadcrumbs. Adds a class if is currentURL
		* Adding URL_ROOT to each component for proper anchoring.
		*
		* NOte to self: Inject (setter) the text with text to "Home"
		*/
		public function breadcrumbs(){
			$currentRequest = $this->routes->getCurrentRequest();
			$crumb = $this->create("","Hem");
			$controller = strtolower($currentRequest->getController());
			$method = strtolower($currentRequest->getMethod());
			$crumb .= (!empty($controller)) ? $this->isCurrentURL($controller, ucfirst($controller)) : "";
			$crumb .= (!empty($method)) ? $this->isCurrentURL($controller."/".$method, ucfirst($method)) : "";
			return $crumb;
		}
		
		/**
		* Checks if breadcrumb is currentUrl and adds cssclass if true.
		*/
		private function isCurrentURL($linkpath,$text){

			//This is only a problem in indexpage. If controller is HOME constant it is displayed twice. If so return empty.
			if(strtolower($linkpath) == strtolower(URL_ROOT . HOME)){return "";}

			if(URL_ROOT.$linkpath == $this->url->getCurrentURLWithoutQueryString()){
				return "<span class='".$this->cssClass."'>".$this->create($linkpath,$text)."</span>";
			}
			return $this->create($linkpath,$text);
		}
		
		/**
		* Getter for path property
		*/
		public function getPath(){
			return $this->path;
		}
	}