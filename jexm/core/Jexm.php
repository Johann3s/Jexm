<?php
	namespace jexm\core;
	use \jexm\core\tables\CreateTables as Tables;
	use \jexm\core\facades\Dispatcher as Dispatcher;
	/**
	* This is the Jexm obj.
	*
	*/
	
	class Jexm{
		
		/**
		* @var object Dispatcher object serving app with controllers.
		*/
		protected $dispatcher;
		
		/**
		* @var object Controller object.
		*/
		protected $controller;
		
		/**
		* @var object || string Viewclass or plain string
		*/
		protected $view;
		
		/**
		* Starts the application
		*/
		public function launch(){
			$tables = (new Tables())->createUserTable();
			//$tables->createUserTable();
			//$this->dispatcher = new Dispatcher();
			$this->controller = Dispatcher::getController();
			$this->view = $this->controller->invoke();
			$this->renderResponse();
		}
		
		protected function renderResponse(){
			if(is_object($this->view)){
				$this->view->display();
			}
			if(is_string($this->view)){
				echo $this->view;
			}
		}
	}