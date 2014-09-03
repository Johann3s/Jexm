<?php
	namespace jexm\core;
	/**
	* This is the basecontroller which is to be extended by an application specific controller.
	*/
	class BaseController{
		
		/**
		* @var object Holds the view object
		*/
		protected $view;
		
		/**
		* @var string Holds the basename of current controller
		*/
		protected $controllerName;
		
		public function __construct(){
			$this->controllerName = BaseHelper::getClassName($this);
			$this->setView();
		}
		
		
		/**
		* Sets view object if file exists
		* @return void
		*/
		protected function setView(){
			$viewObj = "\\jexm\\views\\" . $this->controllerName;
			$this->view = (file_exists(JEXM_PATH."views".DS.$this->controllerName.".php")) ? new $viewObj() : null;
		}
	}                                                                             
	