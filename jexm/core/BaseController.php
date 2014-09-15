<?php
	namespace jexm\core;
	
	/**
	* This is the basecontroller which is to be extended by an application specific controller.
	*/
	use \jexm\core\helpers\JexmSession as Session;
	
	abstract class BaseController{
		
		
		public function __construct(){
			$this->createAliases();
			$this->callMethod();
		}
		
		/**
		* Create aliases for namespaced classes allowing them to be included in extended classes without "use"
		*/
		protected function createAliases(){
			\class_alias('jexm\core\View','jexm\controllers\View');
			\class_alias('jexm\core\helpers\JexmURL','jexm\controllers\URL');
			\class_alias('jexm\core\helpers\JexmSession','jexm\controllers\Session');
			\class_alias('jexm\core\helpers\JexmRedirect','jexm\controllers\Redirect');
			\class_alias('jexm\core\helpers\JexmUserInput','jexm\controllers\Input');
			\class_alias('jexm\core\helpers\JexmLink','\Link');
		}
		
		/**
		* Calls requested method(if any, otherwise index method)
		*/
		protected function callMethod(){
			$request = Session::getMethodRequest();
			$method = (method_exists($this, $request)) ? $request : "index";
			$this->{$method}();		
		}
		
		
	}                                                                             
	