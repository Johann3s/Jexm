<?php
	namespace jexm\core;
	
	/**
	* This is the basecontroller which is to be extended by an application specific controller.
	*/
	//use \jexm\core\helpers\JexmURL as URL;
	
	abstract class BaseController{
		
		use \jexm\core\traits\ControllerHelpers;
		/**
		* @var array Holds current request as associative array.
		*/
		protected $currentRequest = array();
		
		
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
			$routes = \jexm\core\Routes::getRoutesObject();
			$this->currentRequest = $routes->getCurrentRequest();
	
			if(\jexm\core\BaseHelper::getClassName($this) == ucfirst($this->currentRequest['controller'])){
				$this->setControllerHelpers();
				$this->callMethod();
			}
			
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
		* Calls requested method(if any) or sends a 404 if not method not found
		*/
		protected function callMethod(){
			$method = $this->currentRequest['method'];
			if(empty($method)){return;}
			if(!method_exists($this, $method)){
				\jexm\core\BaseHelper::send404();
				exit;
			}
			$this->{$method}();		
		}
		
		
	}                                                                             
	