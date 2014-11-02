<?php
	namespace jexm\core;
	
	class JSON{
		
		protected $data;
		
		public function respond($data){
			$this->data = json_encode($data);
			return $this;
		}
		
		public function display(){
			header('Content-Type: application/json');
			echo $this->data;
			exit;
		}
		
	}