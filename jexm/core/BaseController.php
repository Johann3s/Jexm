<?php
	namespace jexm\core;
	/**
	* This is the basecontroller which is to be extended by an application specific controller.
	*/
	abstract class BaseController{
		
		/**
		* @var object Holds the view object
		*/
		protected $view;
		
		/**
		* @var string Holds the basename of current controller
		*/
		protected $controllerName;
		
		/**
		* @var array Holds current request as an array
		*/
		protected $urlRequest = array();
		
		
		public function __construct(){
			$this->controllerName = BaseHelper::getClassName($this);
			$this->setView();
			$router = new Router();
			$this->urlRequest = $router->getRoute();
		}
		
		
		/**
		* Sets view object if file exists
		* @return void
		*/
		protected function setView(){
			$viewObj = "\\jexm\\views\\" . $this->controllerName;
			$this->view = (file_exists(JEXM_PATH."views".DS.$this->controllerName.".php")) ? new $viewObj() : null;
		}
		
		/**
		* Pass data to view
		* @param array $data Associative array passed to the view.
		* @return void
		*/
		protected function setData(array $data){
			$this->view->setData($data);
		}
		
		/**
		* Renders the view
		*/
		public function render(){
			$this->view->renderView();
		}
	}                                                                             
	