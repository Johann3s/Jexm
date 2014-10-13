<?php
	namespace jexm\core\helpers;
	
	/**
	* Class to be used in templates for handling linkrelated tasks.
	*/
	class JexmLink{
		
		private $cssClass = "crumbs-current-url";
		
		private $routes;
		
		public function __construct(){
			$this->routes = \jexm\core\route\Routes::getRoutesObject();
		}
		
		/**
		* Creates an a element.
		* @var string $path href-attribute
		* @var string $text Text to be displayed
		* @var string $class Optional css-class.
		* @var array $params Optional getparams (requires assocative array)
		* @return mixed Html element
		*/
		public function create($path, $text, $params = array()){
		
			//Checks if given path is a controller request or regular path. Returns either as it were or with the url specified in matching route.
			$path = $this->routes->linkControllerRequest($path);
			
			$path = (!empty($params)) ? $path . "?" .$this->buildQueryString($params) : $path;
			$path = URL_ROOT . $path;
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
		*/
		public function breadcrumbs(){
			$crumb = $this->create("","Hem");
			$controller = strtolower(JexmSession::getControllerRequest());
			$method = strtolower(JexmSession::getMethodRequest());
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

			if(URL_ROOT.$linkpath == JexmURL::getCurrentURLWithoutQueryString()){
				return "<span class='".$this->cssClass."'>".$this->create($linkpath,$text)."</span>";
			}
			return $this->create($linkpath,$text);
		}
	}