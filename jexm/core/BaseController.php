<?php
	namespace jexm\core;
	
	/**
	* This is the basecontroller which is to be extended by an application specific controller.
	*/
	
	abstract class BaseController{
		
		use \jexm\core\traits\ControllerHelpers;
		
		/**
		* @var obj Holds current request.
		*/
		protected $currentRequest;
		
		
		/**
		* Constructor creates aliases and calls method when done traversing classes
		*/
		public function __construct(){
			$this->currentRequest = \Routes::getCurrentRequest();		
		}
		
		
		
		/**
		* Calls requested method or sends a 404 if no method exists or is not found
		* If args exist pass along as parameters
		*/
		protected function callMethod(){
			$method = $this->currentRequest->getMethod();
			if(empty($method) || !method_exists($this, $method)){
				\jexm\core\BaseHelper::send404();
			}
			return (count($this->currentRequest->getArgs()) > 0) ? $this->{$method}($this->currentRequest->getArgs()) : $this->{$method}();		
		}
		
		/**
		* Invokes the controller
		* @return obj View mostly
		*/
		public function invoke(){
			if(\jexm\core\BaseHelper::getClassName($this) == ucfirst($this->currentRequest->getController())){
				$this->createAliases();
				return $this->callMethod();
			}
		}
		
	}                                                                             
	