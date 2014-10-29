<?php
	namespace jexm\core\db;
	
	class DatabaseQuery extends \jexm\core\BaseModel{
		
		protected $table;
		protected $columns = "";
		protected $conditions = "";
		protected $params = array(); 
		protected $order = "";
		
		public function table($tablename){
			$this->table = $tablename;
			return $this;
		}
		
		/**
		* If no arguments are provided all (*) is assumed.
		*/
		public function select(){
			$args = [];
			if(count(\func_get_args()) < 1){
				$this->columns = "*";
				return $this;
			}
			foreach(\func_get_args() as $arg){
				$args[] = $arg;
			}
			
			$this->columns = implode(",",$args);
			return $this;
		}
		
		/**
		* Assumes and building.
		*/
		public function where($accessor,$operator,$value){
			if(strlen($this->conditions) < 1){
				$this->conditions = " WHERE ".$accessor ." ".$operator. " ?";
				$this->params[] = $value;
				return $this;
			}
			$this->conditions .= " AND ".$accessor ." ".$operator. " ?";
			$this->params[] = $value;
			return $this;
		}
		
		/**
		* Uses or instead of and
		*/
		public function orWhere($accessor,$operator,$value){
			$this->conditions .= " OR ".$accessor ." ".$operator. " ?";
			$this->params[] = $value;
			return $this;	
		}
		
		public function orderBy($column,$order){
			$requestedOrder = ($order == "ASC" || $order == "asc") ? " ASC" : " DESC";
			$this->order = " ORDER BY ".$column.$requestedOrder;
			return $this;
		}
		
		/**
		* executes and returns query
		*/
		public function get(){
			$query = "SELECT ".$this->columns." FROM ".$this->table.$this->conditions.$this->order;
			//var_dump($this->params);die();
			//var_dump($query);die();
			return $this->fetch($query,$this->params);	
		}
		
		public function getCount(){
			$query = "SELECT ".$this->columns." FROM ".$this->table.$this->conditions.$this->order;
			//var_dump($query);die();
			$res = $this->fetch($query,$this->params);
			$count = $this->rowCount;
			var_dump($count);die();
		}
		
	}