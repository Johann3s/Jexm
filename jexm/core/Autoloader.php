<?php
	namespace jexm\core;
	/**
	* Autoloads classes with namespaces as path.
	*
	* Basic autoloader. Scans directories and includes a class if found in allowed directories.
	*/
	class Autoloader{
		
		/**
		* @var array Holds all the files allowed by the autoloader to include
		*/
		private $allowedFilesToRequire = array();
		
		
		public function __construct(){
			$this->validateDirectory(JEXM_PATH);
			spl_autoload_register(array($this,"autoLoadClasses"));
			//print_r($this->allowedFilesToRequest);
		}
		
		
		
		/**
		* Autoloads classes via namespaces.
		* @param string Classname prepended with namespace being instantiated.
		*/
		private function autoLoadClasses($class){
			
			//Replace namespaces to work on all OS's.
			$class = str_replace("\\",DS,$class);
			
			//Validate for existance of file both in array and filesystem
			if(file_exists(ROOT . $class . ".php") && in_array(basename($class),$this->allowedFilesToRequest)){
				require_once(ROOT . $class . ".php");
			}//else{
				//die("Incorrect classname! Could not locate class: $class");
			//}
		}
		
		
		
		/**
		* Scans through allowed directory to validate a valid request.
		* @param string Path to jexm directory.
		*/
		private function validateDirectory($dir){
		
			foreach(glob($dir . "*") as $item){
				
				// If a directory append slash and keep going..
				if(is_dir($item)){
					$this->validateDirectory($item.DS);
				}
				
				// .php extension (ONLY) will be stripped out and remainder pushed to array for comparison.
				if(is_file($item)){
					$this->allowedFilesToRequest[] = basename($item,".php");
				}
			}
			
		}
		
	}
		
	