<?php
	namespace jexm\core\traits;
	
	trait ViewHelpers{
		
		private function setHelpers(){
			
			$this->link = new \jexm\core\helpers\JexmLink();

			
		}
		
	}