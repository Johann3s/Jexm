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
			$this->createAliases();
			$this->currentRequest = \Routes::getCurrentRequest();		
		}
		
		
		/**
		* Create aliases for namespaced classes allowing them to be included in extended classes without "use"
		*/
		protected function createAliases(){
			\class_alias('jexm\core\helpers\JexmURL','jexm\controllers\URL');
			\class_alias('jexm\core\helpers\JexmSession','jexm\controllers\Session');
			//\class_alias('jexm\core\helpers\JexmGlobals','jexm\controllers\Globals');
		}
		
		
		/**
		* Calls requested method or sends a 404 if no method exists or is not found
		*/
		protected function callMethod(){
			$method = $this->currentRequest->getMethod();
			if(empty($method) || !method_exists($this, $method)){
				\jexm\core\BaseHelper::send404();
			}
			return $this->{$method}();		
		}
		
		/**
		* Invokes the controller
		* @return obj View mostly
		*/
		public function invoke(){
			if(\jexm\core\BaseHelper::getClassName($this) == ucfirst($this->currentRequest->getController())){
				$this->setControllerHelpers();
				return $this->callMethod();
			}
		}
		
	}                                                                             
	