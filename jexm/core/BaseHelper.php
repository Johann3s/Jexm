<?php
	namespace jexm\core;
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
			$view = new \jexm\core\View();
			$view->send(["currentRequest" => \jexm\core\helpers\JexmURL::getCurrentURLString()])->render("404")->display();
			exit();
		}
		
		public static function warn($message){
			if(!PRODUCTION){
				trigger_error($message,E_USER_WARNING);
			}
		}
		
		public static function kill($message){
			if(!PRODUCTION){
				trigger_error($message,E_USER_ERROR);
			}			
		}

	}