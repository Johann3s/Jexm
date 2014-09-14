<?php
	namespace jexm\core\helpers;
	
	/**
	* Class to be used in templates for handling linkrelated tasks.
	*/
	class JexmLink{
		
		/**
		* Creates an a element.
		* @var string $path href-attribute
		* @var string $text Text to be displayed
		* @var string $class Optional css-class.
		* @return mixed Html element
		*/
		public static function create($path, $text, $class = ""){
			$a = "<a "; 
			$a .= (!empty($class)) ? "class='{class}' " : "";
			$a .= "href='{$path}'>";
			$a .= $text;
			$a .= "</a>";
			return $a;
		}
		
		//TODO::Create support for breadcrumbs
		public static function breadcrumbs(){
			$crumb = self::create(URL_ROOT,"Start");
			$crumb .= (!empty($_SESSION['CurrentRequest']['controller'])) ? self::create($_SESSION['CurrentRequest']['controller'],$_SESSION['CurrentRequest']['controller']) : "";
			return $crumb;
		}
	}