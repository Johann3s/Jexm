<?php
	namespace jexm\controllers;
	
	class TestController extends Controller{
	
		public function __construct(){
			parent::__construct();
		}
		
		public function index(){
			return View::render('test');
		}
	}