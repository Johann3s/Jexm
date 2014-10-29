<?php
	namespace jexm\models;
	
	class Model extends \jexm\core\BaseModel{
		
		
		public function __construct(){
			parent::__construct();
		}
		

		
		public function getAll(){
			$resultset = $this->fetch("SELECT * FROM article_table WHERE articleid < ? ORDER BY articleid ASC",[50],10);
			var_dump($resultset['paginationLinks']);
			return $resultset;
		}
		
		public function updateSomething(){
			$result = $this->update("UPDATE users SET last_name = 'eftnamed' WHERE id = ?",[7]);
			var_dump($result);
		}
		
		
	}