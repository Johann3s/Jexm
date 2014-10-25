<?php
	namespace jexm\core;
	
	/**
	* Autoloads classes with namespaces as path.
	* Basic autoloader. Scans directories and includes a class if found in allowed directories.
	*/
	class Autoloader{
		
		
		/**
		* @var array Holds all the files allowed by the autoloader to include
		*/
		private $allowedFilesToRequire = array();
		
		
		public function __construct(){
			spl_autoload_register([$this,"autoLoadClasses"]);
		}
		
		
		
		/**
		* Setter for property
		*/
		public function setDirectories(array $validFiles){
			$this->allowedFilesToRequire = $validFiles;
		}
		
		
		
		/**
		* Autoloads classes via namespaces.
		* @param string Classname prepended with namespace being instantiated.
		*/
		private function autoLoadClasses($class){
			
			if(file_exists(JEXM_PATH.DS."core".DS."facades".DS.$class.".php")){
				require_once(JEXM_PATH.DS."core".DS."facades".DS.$class.".php");
				return;
			}
			//Replace namespaces to work on all OS's.
			$class = str_replace("\\",DS,$class);
			
			//Validate for existance of file both in array and filesystem
			if(file_exists(ROOT . $class . ".php") && in_array(basename($class),$this->allowedFilesToRequire)){
				require_once(ROOT . $class . ".php");
			}
		}
	}