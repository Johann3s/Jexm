<?php
	namespace jexm\controllers;
	
	class Test extends Controller{
		
		public function __construct(){
			parent::__construct();
		}
		
		public function idx(){
			return View::send(["first"=>"moahahah","second"=>"hehehe"])->send(["third"=>"hiihii"])->render("test");
		}
		public function postData(){
			var_dump($_POST);
		}
		
		public function showParam(){
			var_dump($this->currentRequest->getArgs());
		}
		public function doRockAndRoll(){
			Redirect::with(["id" => 45])->to("test2@index");
		}
		public function helloWorld(){
			$model = new \jexm\models\Model();
			$data = $model->getAll();
			$links = $data['paginationLinks'];
			return View::send(["data" => $data])->send(["first"=>"moahahah","second"=>"hehehe"])->send(["third"=>"hiihii"])->render("test",["links" => $links]);
		}
	
		public function createUser(){
			$model = new \jexm\models\User();
			$userdata = [
				"firstname" => "Tester",
				"email" => "tester@fakemail.com",
				"password" => $this->hasher->Create("passwordz")
			];
			$returnValue = $model->insertUser($userdata);
			var_dump($returnValue);
			
		}
		
		public function authUser(){
			//$this->auth->login("tester@fakemail.com","passwordz");
			Authenticate::authenticate();
			var_dump($id);
		}
		
		public function logoutUser(){
			unset($_SESSION['jexm_user']);
		}
	}