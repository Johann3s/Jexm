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
			$this->createAliasFromCustomClasses();
		}
		
		public function createAliasFromCustomClasses(){
			$facades = array();
			foreach(glob(JEXM_PATH ."core" .DS. "facades".DS."*") as $facade){
				if(is_dir($facade) || basename($facade,".php") == "Facades"){
					continue;
				}
				$facades[] = basename($facade,".php");
			}
			foreach(glob(JEXM_PATH ."classes".DS. "*.php") as $custom){
				$stripped = basename($custom,".php");
				if(in_array($stripped,$facades)){
					\class_alias('jexm\core\facades\\'.$stripped,'\jexm\controllers\\'.$stripped);
				}
			}
		}
	}