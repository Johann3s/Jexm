<?php
	namespace jexm\controllers;
	
	class Test2 extends Controller{
		
		public function __construct(){
			parent::__construct();
		}
		
		public function index(){
			$var = ["first"=>"<p>åkae ejsan  </p>","second"=>"<h2> öallå </h2>","<b>jAG är BLANDat</b>"];
			$clean = Sanitize::filter($var,['tags','trim','upperFirst']);
			var_dump($clean);
			$this->view->render("merchandise");
		}
		
		public function search(){
			$this->view->render("merchandise_search");
		}
	}