<?php
	namespace jexm\core;
	use \jexm\core\user\CreateUserTable as CreateUserTable;
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
		* Starts the application
		*/
		public function launch(){
			$initTable = new CreateUserTable();
			$this->dispatcher = new Dispatcher();
			$this->controller = $this->dispatcher->getController();
		}
		
	
	}