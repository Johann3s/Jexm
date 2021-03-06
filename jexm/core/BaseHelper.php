<?php
	namespace jexm\core;
	use \jexm\core\facades\View as View;
	use \jexm\core\facades\URL as URL;
	/**
	* Helper methods for classes
	*/
	class BaseHelper{
		
		/**
		* Retreives and returns last part (actual classname) of namespaced class
		* @param object $className Namespaced object.
		* @return string Actual classname without namespace.
		*/
		public static function getClassName($className){
			$nameSpaceArray = explode("\\",get_class($className));
			return end($nameSpaceArray);
		}
		
		
		

		
		
		/**
		* Sends a 404 response and renders 404 view
		*/
		public static function send404(){
			header("HTTP/1.0 404 Not Found");
			View::send(["currentRequest" => URL::getCurrentURLString()])->render("404")->display();
			exit();
		}
		

	}