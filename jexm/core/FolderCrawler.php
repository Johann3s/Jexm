<?php 
	namespace jexm\core;
	
	/**
	* Class browses through jexm dir pushes filenames to array to whitelist.
	* Only done once. For use in autoloader.
	*/
	class FolderCrawler{
		
		
		/**
		* @var object Holds itself,singleton.
		*/
		private static $self;
		
		
		private $allowedFilesToRequest = array();
		
		
		/**
		* Singleton class
		* @return object FolderCrawler(self)
		*/
		public static function getFolderCrawler(){
			if(!isset(self::$self)){
				self::$self = new FolderCrawler();
			}
			return self::$self;
		}
		
		
		
		/**
		* Sets property array with files valid to require
		*/
		public function browseDirectory(){
			$this->validateDirectory(JEXM_PATH);
		}
		
		
		
		/**
		* Gets array with valid files to require.
		*/
		public function getValidFilesToRequire(){
			return $this->allowedFilesToRequest;
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