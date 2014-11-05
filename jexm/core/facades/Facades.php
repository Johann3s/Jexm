<?php
	namespace jexm\core\facades;
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
			$instance = $container->getFromContainer($className);
			
			return (count($args) > 0) ? call_user_func_array(array($instance, $method), $args) : $instance->{$method}();
		}
		
	}