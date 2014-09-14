<?php
	namespace jexm\controllers;
	
	class Merch extends Controller{
		
		public function __construct(){
			parent::__construct();
		}
		
		public function index(){
			View::render("merchandise");
		}
		
		public function search(){
			View::render("merchandise_search");
		}
	}