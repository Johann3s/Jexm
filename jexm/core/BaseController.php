<?php
	namespace jexm\core;
	
	/**
	* This is the basecontroller which is to be extended by an application specific controller.
	*/
	abstract class BaseController{
		
		
		public function __construct(){
			$this->createAliases();
		}
		
		protected function createAliases(){
			\class_alias('jexm\core\View','jexm\controllers\View');
			\class_alias('jexm\core\JexmSession','jexm\controllers\Session');
			\class_alias('jexm\core\JexmURL','jexm\controllers\URL');
			\class_alias('jexm\core\JexmRedirect','jexm\controllers\Redirect');
		}
		
	}                                                                             
	