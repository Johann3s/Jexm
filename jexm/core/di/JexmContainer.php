<?php
	namespace jexm\core\di;
	
	class JexmContainer{
		
		/**
		* @var array Holds all registred classes with closurefn
		*/
		protected $registeredObjects = [];
		
		/**
		* @var object Dependancy injector based on Reflection
		*/
		protected $di;
		
		/**
		* @var object $this
		*/
		private static $self;
		
		
		
		/**
		* Instantiates registry and registration
		*/
		public function __construct(\jexm\core\di\JexmDi $di){
			$this->di = $di;
			$registry = (new \jexm\core\di\JexmContainerRegistry())->registerObjects($this);
		}
		
		
		/**
		* Getter for $this (singleton)
		*/
		public static function getInstance(\jexm\core\di\JexmDi $di){
			if(!isset(self::$self)){ self::$self = new \jexm\core\di\JexmContainer($di); }
			return self::$self;
		}
		
		
		/**
		* Regsistrers an object. Saves classname(same alias as the facade) and function to execute.
		*/
		public function register($classname, $callback){
			$this->registeredObjects[$classname] = ["callback" => $callback];
		}
		
		
		/**
		* Executes function coresponding to registred class. 
		*/
		public function getFromContainer($classname){

			if(isset($this->registeredObjects[$classname])){
				return $this->registeredObjects[$classname]['callback']();
			}

			//Throw exception
			
		}
	
	}