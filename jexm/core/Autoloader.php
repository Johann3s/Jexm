<?php
	namespace jexm\core;
	
	/**
	* Autoloads classes with namespaces as path.
	*/
	class Autoloader{
		
		
		
		public function __construct(){
			spl_autoload_register([$this,"autoLoadClasses"]);
		}
		
		
		
		/**
		* Autoloads classes via namespaces.
		* @param string Classname prepended with namespace being instantiated.
		*/
		private function autoLoadClasses($class){
			
			/*if(file_exists(JEXM_PATH.DS."core".DS."facades".DS.$class.".php")){
				require_once(JEXM_PATH.DS."core".DS."facades".DS.$class.".php");
				return;
			}*/
			//Replace namespaces to work on all OS's.
			$class = str_replace("\\",DS,$class);
			
			//Validate for existance of file both in array and filesystem
			if(file_exists(ROOT . $class . ".php")){
				require_once(ROOT . $class . ".php");
			}
		}
	}