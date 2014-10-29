<?php
	namespace jexm\core\db;
	
	class DatabaseQuery extends \jexm\core\BaseModel{
		
		protected $table;
		
		protected $columns = array();
		protected $conditions = "";
		protected $params = array(); 
		protected $order = "";
		protected $limit = "";
		
		protected $updates = array();
		
		protected $paginate = 0;
		
		/**
		* Holds type of query (update,insert etc..)
		*/
		protected $type;
		
		public function table($tablename){
			$this->table = $tablename;
			return $this;
		}
		

		
		/**
		* CONDITIONS
		* Assumes AND with multiple conditions
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
		* CONDITIONS OR
		* Uses or instead of and
		*/
		public function orWhere($accessor,$operator,$value){
			$this->conditions .= " OR ".$accessor ." ".$operator. " ?";
			$this->params[] = $value;
			return $this;	
		}
		
		/**
		* ORDER CLAUSUL
		* Defaults to DESC if not properly formatted
		*/
		public function orderBy($column,$order){
			$requestedOrder = ($order == "DESC" || $order == "desc") ? " DESC" : " ASC";
			$this->order = " ORDER BY ".$column.$requestedOrder;
			return $this;
		}
		
		
		
		/**
		* Sets limit.
		*/
		public function limit($int = 1){
			$num = (is_numeric($int)) ? $int : 1;
			$this->limit = " LIMIT ".$num;
			return $this;
		}
		
		
		/**
		* paginates query
		*/
		public function paginate($int){
			$this->paginate = (is_numeric($int)) ? $int : 0;
			return $this;
		}
		
		/* ---------- CRUD METHODS ------------ */
		
		
		
		/**
		* SELECT QUERY
		* If no arguments are provided all (*) is assumed.
		*/
		public function select(){
			if(count(\func_get_args()) < 1){
				$this->columns[] = "*";
				return $this;
			}
			foreach(\func_get_args() as $arg){
				$this->columns[] = $arg;
			}
			return $this;
		}		
		
		/**
		* UPDATE QUERY (EQUAL TO SET)
		*/
		public function change($column,$value){
			$this->updates[] = $column." = ?";
			$this->params[] = $value;
			$this->type = "update";
			return $this;
		}
		
		/**
		* DELETE QUERY
		*/
		public function remove(){
			$this->type = "delete";
			return $this;
		}
		
		/**
		* INSERT QUERY
		*/
		public function add($column,$value){
			$this->columns[] = $column;
			$this->params[] = $value;
			$this->type = "insert";
			return $this;
		}
		
		
		/* ------------------- EXECUTION METHODS --------------------- */
		
		
		/**
		* Builds, executes and returns fetch query
		*/
		public function get(){
			$query = "SELECT ".implode(",",$this->columns)." FROM ".$this->table.$this->conditions.$this->order;
			return $this->fetch($query,$this->params,$this->paginate);	
		}
		
		
		
		/**
		* Builds, executes and returns a count of determined query
		*/
		public function getCount(){
			$query = "SELECT ".implode(",",$this->columns)." FROM ".$this->table.$this->conditions.$this->order;
			$res = $this->fetch($query,$this->params);
			return $this->rowCount;
		}		
		
		
		
		
		/**
		* Builds, executes and returns query with regard of requested type (!select).
		*/
		public function execute(){
			switch($this->type){
				case "update" :
					$query = "UPDATE ".$this->table." SET ".implode(",",$this->updates).$this->conditions;
					return $this->update($query,$this->params);
				case "delete" :
					$query = "DELETE FROM ".$this->table.$this->conditions.$this->limit;
					return $this->delete($query,$this->params);
				case "insert" :
					$query = "INSERT INTO ".$this->table. " (".implode(",",$this->columns).") VALUES (";
					
					//populate values with placeholders according to number of insertions
					for($i = 0;$i<count($this->columns);$i++){
						$values[] = "?";
					}
					$query .= implode(",",$values) . ")";
					return $this->insert($query,$this->params);
			}
		}
		

		
	}