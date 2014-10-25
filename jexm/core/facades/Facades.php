<?php
	class Facades{
		
		public static function __callStatic($method,$args){
			return static::identifyClass($method,$args);
		} 
		
		protected static function resolveClass(){
			/*
			* in facades extending this basefacade the resolved classname must be the one set in the registry.
			* Otherwise Jexm wont be able to access it through the facade
			*/
		}
		
		
		/**
		* Identify overloading class with subfacade and determine method and length of args.
		* Get class instance with dependencies from container and execute.
		* @return return value of executed method || null
		*/
		protected static function identifyClass($method,$args){
			$container = \jexm\core\di\JexmContainer::getInstance(new \jexm\core\di\JexmDi());
			$className = static::resolveClass();
			//var_dump($container);
			$instance = $container->getFromContainer($className);///->{$method}($args);
			
			switch(count($args)){
			
				case 0 :
					return $instance->{$method}();
				case 1 : 
					return $instance->{$method}($args[0]);
				case 2 :
					return $instance->{$method}($args[0],$args[1]);
				case 3:
					return $instance->{$method}($args[0],$args[1],$args[2]);
					
			}

		}
		
	}