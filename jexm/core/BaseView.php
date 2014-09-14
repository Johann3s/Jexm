<?php 
	namespace jexm\core;
	/**
	* BaseView holds generic Viewlogic.
	*/
	abstract class BaseView{
		
		
		
		/**
		* this logic is only temporary. Will be exchanged shortly. Mainly here to see that all parts are working.
		*/
		public static function render($templateName,array $data = array()){
			extract($data);
			require_once(TEMPLATE_PATH . $templateName . ".php");
		}
	}