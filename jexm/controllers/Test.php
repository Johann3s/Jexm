<?php
	namespace jexm\controllers;
	
	class Test extends Controller{
		
		public function __construct(){
			parent::__construct();
		}
		
		public function idx(){
			return $this->view->send(["first"=>"moahahah"])->render("test");
		}
		public function postData(){
			var_dump($_POST);
		}
		
		public function showParam(){
			var_dump($this->currentRequest->getArgs());
		}
		public function doRockAndRoll(){
			$this->redirect->to("test2@index");
		}
		public function helloWorld(){
			$model = new \jexm\models\Model();
			$data = $model->getAll();
			$links = $data['paginationLinks'];
			return $this->view->send(["data" => $data])->render("test",["links" => $links]);
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
			$id = $this->auth->authenticate();
			var_dump($id);
		}
		
		public function logoutUser(){
			unset($_SESSION['jexm_user']);
		}
	}