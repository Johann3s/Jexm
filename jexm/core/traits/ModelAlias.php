<?php
	namespace jexm\core\traits;
	
	trait ModelAlias{
		
		public function createAliases(){
			class_alias('jexm\core\facades\User','jexm\models\User');
			class_alias('jexm\core\facades\DB','jexm\models\DB');
		}
		
	}