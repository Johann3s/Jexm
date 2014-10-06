<?php
	namespace jexm\core;
	
	/**
	* The viewclass.
	*/
	class View{
		
		
		/**
		* @var array Data to render with template
		*/
		protected $data = array();
		
		
		
		/**
		* Passes data to property
		* @return self for chaining
		*/
		public function send(array $data){
			$this->data = array_merge($this->data,$data);
			return $this;
		}
		
		
		
		/**
		* Renders the defined template and extracts passed data.
		*/
		public function render($templateName, array $data = array()){
			$this->data = array_merge($this->data,$data);
			//var_dump($this->data);
			extract($this->data);
			require_once(TEMPLATE_PATH . $templateName . ".php");
		}
		
		
		
	}