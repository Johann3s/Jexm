<?php
	namespace jexm\models;
	
	class Model extends \jexm\core\BaseModel implements \jexm\core\interfaces\Aliases{
		
		
		public function __construct(){
			parent::__construct();
			$this->createAliases();
		}
		
	}