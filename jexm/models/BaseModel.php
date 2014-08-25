<?php
	namespace jexm\models;
	use PDO;
	use PDOException;
	
	class BaseModel{
		
		/**
		* @var object PDO object
		*/
		protected $db;
		
		/**
		* @var int Holds last inserted id
		*/
		protected $lastInsertedId;
		
		
		public function __construct(){
			try {
				$this->db = new PDO(DSN, USERNAME, PASSWORD);
				$this->db->SetAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
				$this->db->SetAttribute(PDO::ATTR_EMULATE_PREPARES, false);
			}
			catch(PDOException $e) {
				\jexm\core\LogWriter::writeLog($e->getMessage());
				die("Couldnt connect to database. Please check logfile for further information.");
			}

		}
		
		/*
		* Fetches from database.
		*
		* @param string $query SQL SELECT query to be executed, parameterized or not.
		* @param array $params OPTIONAL params to executed with query
		* @return mixed Fetched data from db
		*/
		protected function fetch($query, $params = array()){
			$stmt = $this->db->prepare($query,$params = array());
			$stmt->execute($params);
			return $stmt->fetchAll();
		}
		
		
		/**
		* Update database.
		*
		* @param string $query SQL UPDATE query to be executed, parameterized or not.
		* @param array $params OPTIONAL params to executed with query
		* @return bool True when row has been affected, false if not
		*/
		protected function update($query,$params = array()){
			return $this->cudData($query,$params);
		}
		
		
		/**
		* Insert into database.
		*
		* @param string $query SQL INSERT query to be executed, parameterized or not.
		* @param array $params OPTIONAL params to executed with query
		* @return bool True when row has been affected, false if not
		*/
		protected function insert($query,$params = array()){
			return $this->cudData($query,$params);
		}
		
		/**
		* DELETE from database.
		*
		* @param string $query SQL DELETE query to be executed, parameterized or not.
		* @param array $params OPTIONAL params to executed with query
		* @return bool True when row has been affected, false if not
		*/
		protected function delete($query,$params = array()){
			return $this->cudData($query,$params);
		}
		
		/**
		* Generic create,update,delete method used internally in class.
		*/
		protected function cudData($query,$params = array()){
			$stmt = $this->db->prepare($query);
			$stmt->execute($params);
			$this->lastInsertedId = $this->db->lastInsertId();
			if($stmt->rowCount() < 1){
				return false;
			}
			return true;
	  }
	  
	  
	  /*
	  * Get last inserted id from database
	  * @return int
	  */
	  protected function getLastInsertedId(){
			return $this->lastInsertedId;
	  }
}