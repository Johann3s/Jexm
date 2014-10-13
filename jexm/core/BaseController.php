<?php
	namespace jexm\core;
	
	/**
	* This is the basecontroller which is to be extended by an application specific controller.
	*/
	//use \jexm\core\helpers\JexmURL as URL;
	
	abstract class BaseController{
		
		use \jexm\core\traits\ControllerHelpers;
		
		/**
		* @var obj Holds current request.
		*/
		protected $currentRequest;
		
		
		/**
		* @var object For authentication.
		*/
		protected $auth;
		
		
		/**
		* @var obj For hashing strings
		*/
		protected $hasher;
		
		/**
		* @var object View class
		*/
		protected $view;
		
		/**
		* Constructor creates aliases and calls method when done traversing classes
		*/
		public function __construct(){
			$this->createAliases();
			$routes = \jexm\core\route\Routes::getRoutesObject();
			$this->currentRequest = $routes->getCurrentRequest();		
		}
		
		
		/**
		* Create aliases for namespaced classes allowing them to be included in extended classes without "use"
		*/
		protected function createAliases(){
			\class_alias('jexm\core\helpers\JexmURL','jexm\controllers\URL');
			\class_alias('jexm\core\helpers\JexmSession','jexm\controllers\Session');
			\class_alias('jexm\core\helpers\JexmUserInput','jexm\controllers\Input');

		}
		
		
		/**
		* Calls requested method or sends a 404 if no method exists or is not found
		*/
		protected function callMethod(){
			$method = $this->currentRequest->getMethod();
			if(empty($method) || !method_exists($this, $method)){
				\jexm\core\BaseHelper::send404();
				exit;
			}
			return $this->{$method}();		
		}
		
		/**
		* Invokes the controller
		* @return obj View
		*/
		public function invoke(){
			if(\jexm\core\BaseHelper::getClassName($this) == ucfirst($this->currentRequest->getController())){
				$this->setControllerHelpers();
				return $this->callMethod();
			}
		}
		
	}                                                                             
	