<?php
	namespace jexm\core;
	
	/**
	* Class for populating and retriveing values from the $_SESSION global.
	* These methods are used in coreclasses only and no alias exist for use outside of core namespace.
	*/
	class CoreSession{
		
		public function setRoute(array $values){
			$_SESSION['CurrentRequest'] = $values;
		}
		
		public function getRoute(){
			return $_SESSION['CurrentRequest'];
		}
	}