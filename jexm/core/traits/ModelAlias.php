<?php
	namespace jexm\core\traits;
	
	trait ModelAlias{
		
		public function createAliases($instance = null){
			$classname = \jexm\core\baseHelper::getClassName($instance);
			if($classname != "User"){
				class_alias('\jexm\core\facades\User','\jexm\models\User');
				class_alias('\jexm\core\facades\DB','\jexm\models\DB');
				class_alias('\jexm\core\facades\Sanitizer','\jexm\models\Sanitizer');
			}
			$this->createAliasFromCustomClasses();
		}
		
		public function createAliasFromCustomClasses(){
			foreach(glob(JEXM_PATH ."core" .DS. "facades".DS."custom".DS."*.php") as $facade){
				$stripped = basename($facade,".php");
				\class_alias('jexm\core\facades\custom\\'.$stripped,'\jexm\models\\'.$stripped);
			}
		}		
		
	}