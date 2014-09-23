<?php
	namespace jexm\core;
	
	/**
	* The viewclass.
	*/
	class View{
		
		
		/**
		* this logic is only temporary. Will be exchanged shortly. Mainly here to see that all parts are working.
		*/
		public static function render($templateName,array $data = array()){
			extract($data);
			require_once(TEMPLATE_PATH . $templateName . ".php");
		}
		
	}