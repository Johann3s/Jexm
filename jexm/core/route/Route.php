<?php
	namespace jexm\core\route;
	
	class Route{
		
		public $url;
		public $location;
		public $requestMethod;
		public $paramName;
		public $hasParam;
		
		
		/**
		* Sets properties and returns itself
		*/
		public function set($url,$location,$reqMethod){
			$this->hasParam = false;
			$this->url = $this->parseUrl($url);
			$this->location = $location;
			$this->requestMethod = $reqMethod;
			return $this;
		}
		
		
		/**
		* IF an argument has been declared in route. Extract argumentname and strip url of last bit.
		* Comparison will be made with same -strip- from $_SERVER[request_uri']
		*/
		private function parseUrl($url){
			$startIdx = strpos($url,"<");
			if(!$startIdx){
				$this->paramName = "";
				return $url;
			}else{
				$this->paramName = substr($url,$startIdx);
				$this->paramName = str_replace(["<",">"],"",$this->paramName);
				$this->hasParam = true;
				return preg_replace("/[\/]{1}[<]{1}[\w \d]+[>]{1}/","",$url);
			}
		}
		
		
		/**
		* Returns param based on url. 
		* @param string @param Realurl, Last part only (paramname defined in route)
		*/
		public function getParam($urlParam){
			if(!$this->hasParam){
				return array();
			}
			return (object)[$this->paramName => $urlParam];		
		}
		
	
	}