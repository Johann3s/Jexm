<?php
	namespace jexm\core\facades\alias;
	class Aliases{
		       
		public function init(){
			
			foreach(glob(dirname(__DIR__) .DS. "*") as $facade){
				if(is_dir($facade) || basename($facade,".php") == "Facades"){
					continue;
				}
				\class_alias('jexm\core\facades\\'.basename($facade,".php"),basename($facade,".php"));
			}
			
		}
		
	}