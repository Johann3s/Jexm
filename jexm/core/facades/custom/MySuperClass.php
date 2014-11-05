<?php
	namespace jexm\core\facades\custom;
	class MySuperClass extends \jexm\core\facades\Facades{
		
		public static function resolveClass(){
			return "MySuperClass";
		}
		
	}