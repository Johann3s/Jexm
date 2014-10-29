<?php 
	namespace jexm\core;
	
	/**
	* Class browses through jexm dir pushes filenames to array to whitelist.
	* Only done once. For use in autoloader.
	*/
	class FolderCrawler{
		
		
		
		private $allowedFilesToRequest = array();
		
		
		
		/**
		* Sets property array with files valid to require
		*/
		public function returnDirectory($dir){
			$this->validateDirectory($dir);
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
				
				// push to array
				if(is_file($item)){
					$this->allowedFilesToRequest[] = basename($item);
				}
			}
			
		}
		
	}