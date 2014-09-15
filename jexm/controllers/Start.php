<?php
	namespace jexm\controllers;
	
	class Start extends Controller{
		
		public function __construct(){
			parent::__construct();
		}
		
		public function index(){
			View::render("home");
		}
		
		public function stuff(){
			var_dump(Input::get("id"));
			View::render("home_stuff");
		}
	}