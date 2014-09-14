<?php 
	namespace jexm\core;
	
	/**
	* Dispatcher class uses the routes and returns controller object.
	*/
	class Dispatcher{
	
		/**
		* @var object CoreSession object.
		*/
		private $session;
		
		/**
		* @var object Router parses the urlrequest.
		*/
		protected $router;
		
		/**
		* @var array Holds the chunked up parts of a URLrequest.
		*/
		protected $routeparts = array();
		
		/**
		* @var string Full path to controller directory.
		*/
		private $controllerDir;
		
		
		
		public function __construct(){
			$this->router = new \jexm\core\Router();
			$this->router->extractRoute();
			$this->controllerDir = JEXM_PATH."controllers".DS;
			$this->session = new CoreSession();
			$this->routeparts = $this->session->getRoute();
		}
		
		
		/**
		* Validates request and returns a controller.
		* @return object
		*/
		public function getController(){
			
			/**
			* If no request has been made array[controller-index] is empty and the indexpage is requested.
			*/
			$controllerFile = (!empty($this->routeparts['controller'])) ? $this->routeparts['controller'].".php" : "Index.php";
			
			/**
			* If a request has been made but controllerfile is not found in dir its a 404. Note to self (change default later)
			*/
			$controller = (file_exists($this->controllerDir.$controllerFile)) ? $this->routeparts['controller'] : "FileNotFound"; 
			
			/**
			* Include namespace for controllers and return controller.
			*/
			$controller = "jexm\controllers\\" . $controller;
			return new $controller();
			
		}
		
	}