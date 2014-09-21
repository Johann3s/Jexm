<?php
	namespace jexm\core;
	
	/**
	* This is the basecontroller which is to be extended by an application specific controller.
	*/
	use \jexm\core\helpers\JexmSession as Session;
	use \jexm\core\View as View;
	use \jexm\core\helpers\JexmURL as URL;
	
	abstract class BaseController{
		
		/**
		* Constructor creates aliases and calls method when done traversing classes
		*/
		public function __construct(){
			$this->createAliases();
			if(\jexm\core\BaseHelper::getClassName($this) == ucfirst(Session::getControllerRequest())){
				$this->callMethod();
			}
			
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
		* Calls requested method(if any) or sends a 404 if not method not found
		*/
		protected function callMethod(){
			$method = Session::getMethodRequest();
			if(empty($method)){return;}
			if(!method_exists($this, $method)){
				View::render("404",array("currentRequest" => URL::getCurrentURLString()));
				exit;
			}
			$this->{$method}();		
		}
		
		
	}                                                                             
	