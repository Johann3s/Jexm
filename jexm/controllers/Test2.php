<?php
	namespace jexm\controllers;
	
	class Test2 extends Controller{
		
		public function __construct(){
			parent::__construct();
		}
		
		public function index(){
			$var = ["first"=>"<p>åkae ejsan  </p>","second"=>"<h2> öallå </h2>","<b>jAG är BLANDat</b>"];
			$clean = Sanitizer::filter($var,['tags','trim','upperFirst']);
			var_dump($clean);
			$x = Hasher::Create("Merchandise");
			var_dump($x);
			$get = Globals::get('id');
			var_dump($_GET['id']);
			var_dump($get);
		}
		
	}