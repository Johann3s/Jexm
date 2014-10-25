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
		
		protected $templateName;
		
		protected $twig;
		
		public function __construct($loader){
			$this->twig = new \Twig_Environment($loader, ['debug' => true]);
		}
		
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
			(strpos($this->templateName,".tpl") == true) ? $this->renderTwig() : $this->renderNormal();
		}
		
		
		/**
		* Renders view with twig. Helpers must be passed into twig environment
		*/
		protected function renderTwig(){
			$this->send(["link" => new \jexm\core\helpers\JexmLink(\jexm\core\route\Routes::getInstance())]);
			echo $this->twig->render($this->osSafe($this->templateName) . ".php", $this->data);
		}
		
		
		/**
		* Renders view with plain php
		*/
		protected function renderNormal(){
			extract($this->data);
			require_once(TEMPLATE_PATH . $this->osSafe($this->templateName) . ".php");
		}
		
	}