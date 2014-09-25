<?php
	namespace jexm\controllers;
	
	class Merch extends Controller{
		
		public function __construct(){
			parent::__construct();
		}
		
		public function index(){
			$var = ["first"=>"<p>Hejsan  </p>","<h2>  Hallå</h2>","<b>JAG är BLANDat</b>"];
			$clean = Sanitize::filter($var,['tags','trim']);
			var_dump($clean);
			View::render("merchandise");
		}
		
		public function search(){
			View::render("merchandise_search");
		}
	}