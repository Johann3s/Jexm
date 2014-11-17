<?php
	namespace jexm\core\route;
	
	/**
	* Holds current request.
	* Methods and props are self-explanatory.
	*/
	class CurrentRequest{
		
		protected $controller;
		
		protected $method;
		
		protected $args;
		
		
		/**
		* @param array $request Injected from Routesobject.
		*/
		public function set(array $request){
			$this->controller = $request['controller'];
			$this->method = $request['method'];
			$this->args = $request['args']; 
			return $this;
		}
	
		public function getController(){
			return $this->controller;
		}
		
		
		public function getMethod(){
			return $this->method;
		}
		
		
		public function getArgs(){
			return $this->args;
		}
	}