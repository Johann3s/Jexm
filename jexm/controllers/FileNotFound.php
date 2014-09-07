<?php
	namespace jexm\controllers;
	
	class FileNotFound extends Controller{
		
		public function __construct(){
			parent::__construct();
			$this->setData(array("currentRequest" => $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']));
			$this->render();
		}
		
	
		
	}