<?php
	namespace jexm\controllers;
	
	class Merch extends Controller{
		
		public function __construct(){
			parent::__construct();
		}
		
		public function index(){
			$var = ["first"=>"<p>åkae ejsan  </p>","second"=>"<h2> öallå </h2>","<b>jAG är BLANDat</b>"];
			$clean = Sanitize::filter($var,['tags','trim','upperFirst']);
			var_dump($clean);
			View::render("merchandise");
		}
		
		public function search(){
			View::render("merchandise_search");
		}
	}