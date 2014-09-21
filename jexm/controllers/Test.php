<?php
	namespace jexm\controllers;
	
	class Test extends Controller{
		
		public function __construct(){
			parent::__construct();
		}
		
		public function helloWorld(){
			View::render("404",array("currentRequest" => "hello world!"));
		}
	
		
	}