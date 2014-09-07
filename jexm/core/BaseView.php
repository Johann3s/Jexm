<?php 
	namespace jexm\core;
	/**
	* BaseView meant to be extended by application specific views.
	*/
	abstract class BaseView{
		
		protected $template;
		protected $data = array(); //array
		
		
		public function setData(array $data){
			$this->data = array_merge($this->data,$data);
		}
		
		/**
		* Decides which template to use.
		* @param string $template Templatename without extension to use. Must reside within views/templates/currentViewClass/
		*/
		protected function useTemplate($template){
			$templatePath = JEXM_PATH."views".DS."templates".DS.BaseHelper::getClassName($this).DS.$template.".php";
			$this->template = (file_exists($templatePath)) ? $templatePath : die("Could not locate requested template!");
		}
		
		/**
		* this logic is only temporary. Will be exchanged shortly. Mainly here to see that all parts are working.
		*/
		public function renderView(){
			//var_dump($this->data);
			extract($this->data);
			require_once($this->template);
		}
	}