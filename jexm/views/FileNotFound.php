<?php 
	namespace jexm\views;
	/**
	* View for FileNotFound
	*/
	class FileNotFound extends View{
		
		public function __construct(){
			parent::__construct();
			$this->useTemplate("404");
			$this->setData(array("currentRequest" => $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']));
			$this->renderView();
		}
	}