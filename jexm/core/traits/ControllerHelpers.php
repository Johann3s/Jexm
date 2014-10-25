<?php
	namespace jexm\core\traits;
	
	trait ControllerHelpers{
		
		protected function setControllerHelpers(){
			class_alias('\View','\jexm\controllers\View');
			class_alias('\Authenticate','\jexm\controllers\Authenticate');
			class_alias('\Hasher','\jexm\controllers\Hasher');
			class_alias('\Redirect','\jexm\controllers\Redirect');
			class_alias('\Sanitizer','\jexm\controllers\Sanitizer');
			class_alias('\Globals','\jexm\controllers\Globals');
			class_alias('\Link','\jexm\controllers\Link');
			class_alias('\User','\jexm\controllers\User');
		}
		
	}