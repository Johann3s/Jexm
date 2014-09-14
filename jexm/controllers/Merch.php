<?php
	namespace jexm\controllers;
	
	class Merch extends Controller{
		
		public function __construct(){
			parent::__construct();
			View::render("merchandise");
		}
	}