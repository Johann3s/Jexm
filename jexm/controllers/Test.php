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
		
		public function showParam($idx){
			var_dump($idx);
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
		
		public function updateSomething(){
			$model = new \jexm\models\Model();
			$model->updateSomething();
		}
		
		public function authUser(){
			$loginId = Authenticate::login(["email" => "tester@fakemail.com","password" => "passwordz"]);
			//$id = Authenticate::check();
			var_dump($loginId);
		}
		
		public function logoutUser(){
			unset($_SESSION['jexm_user']);
		}
		
		public function modelTest(){
			$model = new \jexm\models\testModel();
			$result = $model->getstuff();
			$links = $result['paginationLinks'];
			return View::send(["links" => $links])->send(["response" => $result])->render("qbtest");
			//var_dump($result);
		}
		public function delete(){
			$model = new \jexm\models\testModel();
			$result = $model->deletestuff();
			var_dump($result);
		
		}
		public function update(){
			$model = new \jexm\models\testModel();
			$result = $model->updatestuff();
			var_dump($result);
		}		
		public function add(){
			$model = new \jexm\models\testModel();
			$result = $model->addstuff();
			var_dump($result);
		}	
		public function join(){
			$model = new \jexm\models\testModel();
			$result = $model->joinstuff();
			var_dump($result);
		}			
	}