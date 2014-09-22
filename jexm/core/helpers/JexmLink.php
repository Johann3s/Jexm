<?php
	namespace jexm\core\helpers;
	
	/**
	* Class to be used in templates for handling linkrelated tasks.
	*/
	class JexmLink{
		
		private static $cssClass = "crumbs-current-url";
		
		/**
		* Creates an a element.
		* @var string $path href-attribute
		* @var string $text Text to be displayed
		* @var string $class Optional css-class.
		* @var array $params Optional getparams (requires assocative array)
		* @return mixed Html element
		*/
		public static function create($path, $text, $params = array()){
			$path = (!empty($params)) ? $path . "?" .self::buildQueryString($params) : $path;
			$path = URL_ROOT . $path;
			return "<a href='{$path}'>{$text}</a>"; 
		}
		
		
		/**
		* Automates creation of pagination links.
		*/
		public static function paginate($path, $text, array $params){
			$path = $path . "?" . self::buildQueryString($params);
			return "<a href='{$path}'>{$text}</a>"; 
		}
		
		
		/**
		* Builds querystrings.
		*/
		private static function buildQueryString(array $params){
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
		public static function breadcrumbs(){
			$crumb = self::create("","Hem");
			$controller = strtolower(JexmSession::getControllerRequest());
			$method = strtolower(JexmSession::getMethodRequest());
			$crumb .= (!empty($controller)) ? self::isCurrentURL($controller, ucfirst($controller)) : "";
			$crumb .= (!empty($method)) ? self::isCurrentURL($controller."/".$method, ucfirst($method)) : "";
			return $crumb;
		}
		
		/**
		* Checks if breadcrumb is currentUrl and adds cssclass if true.
		*/
		private static function isCurrentURL($linkpath,$text){

			//This is only a problem in indexpage. If controller is HOME constant it is displayed twice. If so return empty.
			if(strtolower($linkpath) == strtolower(URL_ROOT . HOME)){return "";}

			if(URL_ROOT.$linkpath == JexmURL::getCurrentURLWithoutQueryString()){
				return "<span class='".self::$cssClass."'>".self::create($linkpath,$text)."</span>";
			}
			return self::create($linkpath,$text);
		}
	}