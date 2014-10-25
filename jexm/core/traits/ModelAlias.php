<?php
	namespace jexm\core\traits;
	
	trait ModelAlias{
		
		protected function setAlias(){
			class_alias('\User','\jexm\models\User');
		}
		
	}