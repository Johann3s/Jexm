<?php
	namespace jexm\core\helpers;
	
	/**
	* Class for filtering.
	* Accepts onedimensional array or simple var to filter.
	*/
	class JexmSanitizer{
		
		protected $tempContainer = array();
		
		/**
		* Filters either simple var or 1d-arrays. Allows associative keys.
		* @param mixed $filterMe Var or array to be filtered
		* @param array $methods Methods to execute on given variable.
		* @return filtered variable
		*/
		public function filter($filterMe,array $methods){
			$filtered = $filterMe;
			foreach($methods as $method){
				$filtered = $this->{$method}($filtered);
			}
			return $filtered;
		}
		
		
		//Strips HTML tags
		private function tags($var){
			return (is_array($var)) ? array_map('strip_tags',$var) : strip_tags($var);
		}
		
		
		//Trims text
		private function trim($var){
			return (is_array($var)) ? array_map('trim',$var) : trim($var);	
		}
		
		
		//Uppercases first word (calls makeUpperFirst method)
		private function upperFirst($var){
			return (is_array($var)) ? array_map([$this,'makeUpperFirst'],$var) : $this->makeUpperFirst($var);
		}
		
		private function test($var){
			if($this->containsObjects($var)){
				return $this->loopThrough($var,'test');
			}
			return (is_array($var)) ? array_map([$this,'makeUpperFirst'],$var) : $this->makeUpperFirst($var);
		}
		
		
		//Returns ut8 in consideration uppercased words.
		private function makeUpperFirst($str){
			//return mb_convert_case($str, MB_CASE_TITLE, "UTF-8");
			return strtolower($str);
		}
		
		
		//check if param contains objects (ie dbfetch)
		private function containsObjects($var){
			if(is_array($var)){
				foreach($var as $arr){
					if(is_object($arr)){
						return true;
					}
				}
			}
			return false;
		}
		
		
		//typecast obj to array or vice versa.
		private function convert($var,$type){
			return ($type == 'array') ? (array) $var : (object) $var;
		}
		
		
		//Cast to array then cast back to object. Insert into array again and return.
		private function loopThrough($var,$method){
			$return = [];
			foreach($var as $obj){   
				$casted = $this->convert($obj,'array');
				$invoked = $this->{$method}($casted);
				$return[] = $this->convert($invoked,'object');
			}
			return $return;
		}
	}