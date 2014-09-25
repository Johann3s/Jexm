<?php
	namespace jexm\core\helpers;
	
	/**
	* Class for filtering.
	* Accepts onedimensional array or simple var to filter.
	*/
	class JexmSanitizer{
		
		
		/**
		* Filters either simple var or 1d-arrays. Allows associative keys.
		* @param mixed $filterMe Var or array to be filtered
		* @param array $methods Methods to execute on given variable.
		* @return filtered variable
		*/
		public static function filter($filterMe,array $methods){
			$filtered = $filterMe;
			foreach($methods as $method){
				$filtered = self::{$method}($filtered);
			}
			return $filtered;
		}
		
		
		//Strips HTML tags
		private static function tags($var){
			$filtered;
			if(is_array($var)){
				foreach($var as $key => $val){
					$filtered[$key] = strip_tags($val);
				}
				return $filtered;
			}
			return strip_tags($var);
		}
		
		
		//Trims text
		private static function trim($var){
			$filtered;
			if(is_array($var)){
				foreach($var as $key => $val){
					$filtered[$key] = trim($val);
				}
				return $filtered;
			}
			return strip_tags($var);		
		}
		
		
	}