<?php
	namespace jexm\core\helpers;
	
	/**
	* Class for resolving internal paths from views.
	* (form actions, assets dirs etc..
	*/
	class JexmPathResolver{

		/**
		* @var object LinkClass
		*/
		protected $link;
	
		public function __construct(\jexm\core\helpers\JexmLink $link){
			$this->link = $link;
		}
		
		
		/**
		* Creates a path from controller@method
		*/
		public function create($path){
			$check = explode("@",$path);
			if(count($check) != 2){throw new \Exception('Faulty formatted path. Correct format is Controller@method');}
			$garbage = $this->link->create($path,"");
			return $this->link->getPath();
		}
		
		
		/**
		* Creates a path to assets
		*/
		public function asset($path){
			if(file_exists(PUBLIC_PATH.$path)){
				return (URL_ROOT == "/") ? URL_ROOT.$path : URL_ROOT."/".$path;
			}
			throw new \Exception("Unable to locate requested file ".PUBLIC_PATH.$path);
		}
		
	}