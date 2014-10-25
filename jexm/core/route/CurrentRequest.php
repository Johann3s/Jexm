<?php
	namespace jexm\core\route;
	
	class CurrentRequest{
		
		protected $controller;
		
		protected $method;
		
		protected $args;
		
		
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