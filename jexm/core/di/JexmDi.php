<?php
	namespace jexm\core\di;
	
	class JexmDi{
		
		
		public static function get($class){
			$dependencies = self::getDependencies($class);
		}
		
		private static function getDependencies($class){
			$reflection = new \ReflectionClass($class);
			$constructor = $reflection->getConstructor();
			//var_export($constructor);die();
			$params = $constructor->getParameters();
			foreach($params as $param){
				$c = $param->getClass();
				var_dump($c);
			}
			//var_export($params);
			die();
		}
	}