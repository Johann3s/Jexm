<?php 
	namespace jexm\views;
	/**
	* View for FileNotFound
	*/
	class FileNotFound extends View{
		
		public function __construct(){
			parent::__construct();
			$this->useTemplate("404");
			$this->setData(array("testdata" => "We are ever so sorry!"));
			//var_dump($this->data);
		}
	}