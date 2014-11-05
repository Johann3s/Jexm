<?php
	namespace jexm\core\di;
	use \jexm\core\BaseHelper as BaseHelper;
	
	class JexmDi{
		
		protected $objects = [];
		protected $instantiatedObjects = [];
		protected $reflection;
		
		
		/**
		* Point of access from outside. Inspects class and returns class instantly if no constructor exist. 
		* Otherwise piles down its dependencies and returns objects.
		* @param string Namespaced class
		* @return object Instantiated class with dependencies injected.(recursively)
		*/
		public function get($class){
			
			$this->reflection = new \ReflectionClass($class);
			$constructor = $this->reflection->getConstructor();

			if(is_null($constructor)){
				return new $class();
			}else{
				$this->getDependencies($class,$constructor);
				return $this->instantiateAndReturn($class);
			}
		}
		
		
		
		
		/**
		* Fetches the params from constructor
		*/
		private function getDependencies($class,$constructor){
			$params = $constructor->getParameters();
			$this->gatherDependenciesFromParams($params);
		}
		
		
		
		
		/**
		* Gathers the data representing class (classname with namespace)
		* and populates objects array.
		*/
		private function gatherDependenciesFromParams($params){
			foreach($params as $param){
				if($param->isArray()){
					throw new \Excpetion("An array was injected into the constructor. Only instantiable objects may be injected. Please use a setter if an array is a dependency");
				}
				if(is_null($param->getClass())){
					continue;
				}
				$this->objects[] = $param->getClass();
			}
		}
		
		
		
		/**
		* Instantiates class and injects dependencies recursively. 
		* If dependency have dependencies they will be instantiated aswell.
		*/
		private function instantiateAndReturn($class){
			
			foreach($this->objects as $object){
				$this->instantiatedObjects[] = (new JexmDi)->get($object->name);
			}
			return $this->reflection->newInstanceArgs($this->instantiatedObjects);
			
		}
	}