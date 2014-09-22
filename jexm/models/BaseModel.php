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
		* @var object Paginator class
		*/
		protected $paginator;
		
		/**
		* @var int Holds last inserted id
		*/
		protected $lastInsertedId;
		
		
		public function __construct(){
			try {
				$this->db = new PDO(DSN, USERNAME, PASSWORD);
				$this->db->SetAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
				$this->db->SetAttribute(PDO::ATTR_EMULATE_PREPARES, false);
			}
			catch(PDOException $e) {
				\jexm\core\LogWriter::writeLog($e->getMessage());
				die("Couldnt connect to database. Please check logfile for further information.");
			}
			$this->paginator = new \jexm\core\Paginator();
		}
		
		/*
		* Fetches from database.
		*
		* @param string $query SQL SELECT query to be executed, parameterized or not.
		* @param array $params OPTIONAL params to executed with query
		* @param int $paginate If is set returns only the number set and pagination links.
		* @return mixed Fetched data from db
		*/
		protected function fetch($query, $params = array(), $paginate = 0){
			if($paginate > 0){
				 return $this->doPaginationQuery($query,$params,$paginate);
			}else{
				$stmt = $this->db->prepare($query);
				$stmt->execute($params);
				return $stmt->fetchAll();
			}
		}
		
		/**
		* If pagination is set this block executes instead. It returns query after pagination has been performed and 
		* a set of links with getparameters for current pagination.
		* Params are taken from the fetch() method which is the method being called from the Model class.
		*/
		protected function doPaginationQuery($query,$params,$perPage){
			
			//checks if another page is being requested
			$currentPage = (isset($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page'] : 1;
			
			//Initial query runs to determine total count (setter in codeblock below)
			$stmt = $this->db->prepare($query);
			$stmt->execute($params);
			
			//Sets properties in paginatorobj.
			$this->paginator->setCurrentPage($currentPage);
			$this->paginator->setTotalCount($stmt->rowCount());
			$this->paginator->setPerPage($perPage);
			
			
			//Adds paginator sql to query and pushes corresponding bindparams to array
			$params[] = $this->paginator->getLimit();
			$params[] = $this->paginator->getOffset();
			$paginationQuery = $query . " LIMIT ? OFFSET ?";
			
			//Paginated query runs
			$stmt = $this->db->prepare($paginationQuery);
			$stmt->execute($params);
			
			//Resultset fetched and links are pushed to the set
			$result = $stmt->fetchAll();
			$result['paginationLinks'] = $this->paginator->getLinks();
			return $result;
			
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