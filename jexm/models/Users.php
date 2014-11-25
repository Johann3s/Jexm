<?php
	namespace jexm\models;
	
	class Users extends Model{
		
		/**
		* Change if tablename is NOT users
		*/
		protected $table = "users";
		
		
		
		public function __construct(){
			parent::__construct();
			if(!$tableExist = $this->tableExist($this->table)){
				throw new \Exception("Unable to find table ".$this->table);
			}
		}
		
		
		/**
		* Gets user credentials for authentication
		* Values injected into sqlstring are NOT coming from user.
		* @param array Associative array for fetching userdata given column. [colname => value]
		* @return credentials or false
		*/
		public function getCredentials(array $accessors){
			$accessorColName = array_keys($accessors);
			$accessorValue = array_values($accessors);
			return $this->fetch("SELECT * FROM {$this->table} WHERE {$accessorColName[0]} = ? LIMIT 1",[$accessorValue[0]]);
		}
	}