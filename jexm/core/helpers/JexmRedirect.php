<?php
	namespace jexm\core\helpers;
	
	/**
	* Class for handling redirects.
	* Class is being "aliased-in" into the controllers namespace as Redirect.
	*/
	class JexmRedirect{
		
		/**
		* @var object LinkClass
		*/
		protected $link;
		
		/**
		* @var Holds eventual params from with() method
		*/
		protected $params = [];
		
		
		public function __construct(\jexm\core\helpers\JexmLink $link){
			$this->link = $link;
		}
		
		/**
		* Redirect internally
		*/
		public function to($redirection){
			//method runs to set up property in obj.
			$garbage = $this->link->create($redirection,"",$this->params);
			$location = $this->link->getPath();
			$location = (URL_ROOT != '/') ? URL_ROOT . $location : $location;
			header("Location:" . $location);
			exit;
		}
		
		public function with(array $params){
			$this->params = $params;
			return $this;
		}
		
		/**
		* Redirect externally (out from site)
		*/
		public function out($redirection){
			header("Location:" . $redirection);
			exit;
		}
	}