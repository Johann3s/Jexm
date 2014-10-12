<?php
	namespace jexm\core\route;
	
	class JexmRoute{
		
		public $url;
		public $location;
		public $requestMethod;
		public $paramName;
		public $hasParam;
		
		public function __construct($url,$location,$reqMethod){
			$this->hasParam = false;
			$this->url = $this->parseUrl($url);
			$this->location = $location;
			$this->requestMethod = $reqMethod;
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
		
	
	}