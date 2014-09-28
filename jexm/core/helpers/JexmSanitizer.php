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
			return (is_array($var)) ? array_map('strip_tags',$var) : strip_tags($var);
		}
		
		
		//Trims text
		private static function trim($var){
			return (is_array($var)) ? array_map('trim',$var) : trim($var);	
		}
		
		
		//Uppercases first word (calls makeUpperFirst method)
		private static function upperFirst($var){
			return (is_array($var)) ? array_map(array("\jexm\core\helpers\JexmSanitizer",'makeUpperFirst'),$var) : $self::makeUpperFirst($var);
		}
		
		
		//Returns ut8 in consideration uppercased words.
		private static function makeUpperFirst($str){
			return mb_convert_case($str, MB_CASE_TITLE, "UTF-8");
		}
		
	}