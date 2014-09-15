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
		* Sets current URLRequest. Getter method in JexmSession
		* @param array $routeparts Chunked up associative array with current URLRequest
		*/
		public static function setRoute(array $routeparts){
			$_SESSION['CurrentRequest'] = $routeparts;
		}
		

	}