<?php
	namespace jexm\models;
	
	class Model extends \jexm\core\BaseModel implements \jexm\core\interfaces\Aliases{
		
		use \jexm\core\traits\ModelAlias;
		
		public function __construct(){
			parent::__construct();
			$this->createAliases($this);
		}
		
	}