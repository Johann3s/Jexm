<?php
	namespace jexm\core\traits;
	
	trait ControllerHelpers{
		
		public function createAliases(){
			class_alias('\jexm\core\facades\View','\jexm\controllers\View');
			class_alias('\jexm\core\facades\Authenticate','\jexm\controllers\Authenticate');
			class_alias('\jexm\core\facades\Hasher','\jexm\controllers\Hasher');
			class_alias('\jexm\core\facades\Redirect','\jexm\controllers\Redirect');
			class_alias('\jexm\core\facades\Sanitizer','\jexm\controllers\Sanitizer');
			class_alias('\jexm\core\facades\Globals','\jexm\controllers\Globals');
			class_alias('\jexm\core\facades\Link','\jexm\controllers\Link');
			class_alias('\jexm\core\facades\User','\jexm\controllers\User');
			class_alias('\jexm\core\facades\Session','\jexm\controllers\Session');
			class_alias('\jexm\core\facades\URL','\jexm\controllers\URL');
			class_alias('\jexm\core\facades\JSON','\jexm\controllers\JSON');
			class_alias('\jexm\core\facades\DI','\jexm\controllers\DI');
			class_alias('\jexm\core\facades\Path','\jexm\controllers\Path');
			$this->createAliasFromCustomClasses();
		}
		
		public function createAliasFromCustomClasses(){
			foreach(glob(JEXM_PATH ."core" .DS. "facades".DS."custom".DS."*.php") as $facade){
				$stripped = basename($facade,".php");
				\class_alias('jexm\core\facades\custom\\'.$stripped,'\jexm\controllers\\'.$stripped);
			}
		}
	}