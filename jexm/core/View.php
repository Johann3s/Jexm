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
		* @var string Holds templatename
		*/
		protected $templateName;
		
		
		/**
		* @var object holds Twig env.
		*/
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
		* Renders view with twig. 
		* Helpers must be passed into twig environment
		*/
		protected function renderTwig(){
			$this->send([
				"link" => new \jexm\core\helpers\JexmLink(\jexm\core\route\Routes::getInstance(new \jexm\core\helpers\JexmURL()),new \jexm\core\helpers\JexmURL()),
				"path" => new \jexm\core\helpers\JexmPathResolver(new \jexm\core\helpers\JexmLink(\jexm\core\route\Routes::getInstance(new \jexm\core\helpers\JexmURL()),new \jexm\core\helpers\JexmURL())),
				"session" => new \jexm\core\helpers\JexmSession(),
				"globals" => new \jexm\core\helpers\JexmGlobals()
				]);
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