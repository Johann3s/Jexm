<?php
	namespace jexm\core\traits;
	
	trait ControllerHelpers{
		
		protected function setControllerHelpers(){
			$this->view = new \jexm\core\View();
			$this->auth = new \jexm\core\helpers\JexmAuthentication();
			$this->hasher = new \jexm\core\helpers\JexmHasher();
			$this->redirect = new \jexm\core\helpers\JexmRedirect();
			$this->sanitize = new \jexm\core\helpers\JexmSanitizer();
		}
		
	}