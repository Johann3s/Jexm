<?php
	namespace jexm\core\route;
	
	class CurrentRequest{
		
		protected $controller;
		
		protected $method;
		
		protected $args;
		
		
		
		public function __construct(array $request){
			$this->controller = $request['controller'];
			$this->method = $request['method'];
			$this->args = $request['args']; 
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