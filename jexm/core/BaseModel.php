<?php
	namespace jexm\core;
	use PDO;
	use PDOException;
	
	
	abstract class BaseModel{
		
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
			$resultset = ($paginate > 0) ? $this->doPaginationQuery($query,$params,$paginate) : $this->doQuery($query,$params);
			return $resultset;
		}
		
		
		
		/**
		* If no pagination is requested the "normal" query runs.
		* Takes params from fetch method.
		* @return array Resultset from database.
		*/
		protected function doQuery($query,$params){
			$stmt = $this->db->prepare($query);
			$stmt->execute($params);
			return $stmt->fetchAll();
		}
		
		
		
		/**
		* If pagination is set this block executes instead. It returns query after pagination has been performed and 
		* a set of links with getparameters for current pagination.
		* Params are taken from the fetch() method which is the method being called from the Model class.
		* @return array Resultset from database and pagination links
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
		* Stores id if created.
		* @return boolean True if any rows has been affected by query.
		*/
		protected function cudData($query,$params = array()){
			$stmt = $this->db->prepare($query);
			$stmt->execute($params);
			$this->lastInsertedId = $this->db->lastInsertId();
			return ($stmt->rowCount() > 0);
		}
	  

	  
		/*
		* Get last inserted id from database
		* @return int
		*/
		protected function getLastInsertedId(){
			return $this->lastInsertedId;
		}
}