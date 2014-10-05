<?php
	namespace jexm\controllers;
	
	class Test extends Controller{
		
		public function __construct(){
			parent::__construct();
		}
		
		public function helloWorld(){
			$model = new \jexm\models\Model();
			$data = $model->getAll();
			$links = $data['paginationLinks'];
			View::render("test",["data" => $data, "links" => $links]);
		}
	
		public function createUser(){
			$model = new \jexm\models\User();
			$userdata = [
				"firstname" => "Tester",
				"email" => "tester@fakemail.com",
				"password" => Hasher::Create("passwordz")
			];
			$returnValue = $model->insertUser($userdata);
			var_dump($returnValue);

		}
	}