<?php 
	namespace jexm\core;
	
	/**
	* Dispatcher class uses the routes and returns controller object.
	*/
	class Dispatcher{
		
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
			$routes = \jexm\core\Routes::getRoutesObject();
			$this->routeparts = $routes->getCurrentRequest();
		}
		

		
		/**
		* Validates request and returns a controller.
		* @return object
		*/
		public function getController(){
	
			$controllerFile = ucfirst($this->routeparts['controller']).".php";
			
			//If a request has been made but controllerfile is not found in dir its a 404. Strip $controllerfile of extension.
			$controller = (file_exists($this->controllerDir.$controllerFile)) ? basename($controllerFile,".php") : "404";
			
			//If its a 404. Send header and render 404 template
			if($controller == "404"){
				\jexm\core\BaseHelper::send404();
				exit();
			}
			
			/**
			* Include namespace for controllers and return controller.
			* Eventual method is being set in Routes-class. Then retrieved and called via BaseControllerClass.
			*/
			$controller = "jexm\controllers\\" . $controller;
			return new $controller();
			
		}
		
	}