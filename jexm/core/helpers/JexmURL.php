<?php
	namespace jexm\core\helpers;
	
	/**
	* Class for handling URLrelated tasks. Class is being "aliased-in" into the controllers namespace as URL.
	*/
	class JexmURL{
		
		
		
		/**
		* Returns current full URL
		*/
		public static function getCurrentURLString(){
			return $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		}
		
		
		
		/**
		* Returns only requested path (without eventual querystrings)
		*/
		public static function getCurrentURLWithoutQueryString(){
			if(isset($_SERVER['REDIRECT_QUERY_STRING'])){
				return str_replace("?".$_SERVER['REDIRECT_QUERY_STRING'],"",$_SERVER['REQUEST_URI']);
			}
			return $_SERVER['REQUEST_URI'];
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
			$urlRequest = self::stripURLRequest();
			$urlArray = explode("/",$urlRequest);
			return end($urlArray);
		}
		
		
		/**
		* Gets everything up to last bit of urlstring.
		* @return string
		*/
		public static function getEverythingButLastPartOfUrl(){
			$urlRequest = self::stripURLRequest();
			$urlArray = explode("/",$urlRequest);
			$popped = array_pop($urlArray);
			$url = implode("/",$urlArray);
			return $url;
		}
	}