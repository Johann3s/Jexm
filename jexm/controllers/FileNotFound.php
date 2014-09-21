<?php
	namespace jexm\controllers;
	
	class FileNotFound extends Controller{
		
		public function __construct(){
			parent::__construct();
			View::render("404",array("currentRequest" => URL::getCurrentURLString()));
		}
		
		
	
		
	}