<?php
	namespace jexm\core;
	
	/**
	* The viewclass.
	*/
	class View{
		
		use \jexm\core\traits\ViewHelpers;
		/**
		* @var array Data to render with template
		*/
		protected $data = array();
		
		protected $templateName;
		
		
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
		* @return this object
		*/
		public function render($templateName, array $data = array()){
			$this->data = array_merge($this->data,$data);
			$this->templateName = $templateName;
			return $this;
		}
		
		/**
		* Returns a string with os safe directory separators
		* @return string		
		*/
		private function osSafe($path){
			return str_replace("/",DS,$path);
		}
		
		
		/**
		* Renders the data and template.
		*/
		public function display(){
			$this->setHelpers();
			extract($this->data);
			require_once(TEMPLATE_PATH . $this->osSafe($this->templateName) . ".php");
		}
		
		
	}