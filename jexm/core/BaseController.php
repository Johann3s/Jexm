<?php
	namespace jexm\core;
	
	/**
	* This is the basecontroller which is to be extended by an application specific controller.
	*/
	abstract class BaseController{
		
		
		public function __construct(){
			$this->createAliases();
			$this->callMethod();
		}
		
		protected function createAliases(){
			\class_alias('jexm\core\View','jexm\controllers\View');
			\class_alias('jexm\core\helpers\JexmSession','jexm\controllers\Session');
			\class_alias('jexm\core\helpers\JexmURL','jexm\controllers\URL');
			\class_alias('jexm\core\helpers\JexmRedirect','jexm\controllers\Redirect');
			\class_alias('jexm\core\helpers\JexmLink','\Link');
		}
		
		protected function callMethod(){
			$request = $_SESSION['CurrentRequest']['method'];
			$method = (method_exists($this, $request)) ? $request : "index";
			$this->{$method}();		
		}
		
		
	}                                                                             
	