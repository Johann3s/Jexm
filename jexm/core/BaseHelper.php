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
		* Removes eventual get-strings and
		* strips URL_ROOT from request if URL_ROOT is NOT set to / 
		* @return string URLRequest clean from reduntant path and/or getstrings
		*/
		public static function stripURLRequest(){
			$urlRequest = preg_replace("/[?].+/","",$_SERVER['REQUEST_URI']);
			$urlRequest = (URL_ROOT != "/") ? str_replace(URL_ROOT,"",$urlRequest) : $urlRequest;
			return $urlRequest;
		}
		
		
		/**
		* Gets last part of urlstring.
		* @return string 
		*/
		public static function getLastPartOfUrl(){
			$urlArray = explode("/",$_SERVER['REQUEST_URI']);
			return end($urlArray);
		}
		
		
		/**
		* Gets everything up to last bit of urlstring.
		* @return string
		*/
		public static function getEverythingButLastPartOfUrl(){
			$urlArray = explode("/",$_SERVER['REQUEST_URI']);
			$popped = array_pop($urlArray);
			$url = implode("/",$urlArray);
			return $url;
		}
		
		
		/**
		* Sends a 404 response and renders 404 view
		*/
		public static function send404(){
			header("HTTP/1.0 404 Not Found");
			$view = new \jexm\core\View();
			$view->send(["currentRequest" => \jexm\core\helpers\JexmURL::getCurrentURLString()])->render("404");
			exit();
		}

	}