<?php
	namespace jexm\core\facades\alias;
	class Aliases{
		       
		public function setGlobal(){
			class_alias('jexm\core\facades\Routes','Routes');
			class_alias('jexm\core\facades\Link','Link');
			class_alias('jexm\core\facades\Path','Path');
			class_alias('jexm\core\facades\Sanitizer','Sanitizer');
			class_alias('jexm\core\facades\Session','Session');
			
		}
		
	}