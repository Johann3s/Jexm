<?php
	namespace jexm\controllers;
	
	class Search extends Controller{
		
		public function __construct(){
			parent::__construct();
			Redirect::to('merch');
		}
	}