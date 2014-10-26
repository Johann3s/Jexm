<?php
	namespace jexm\models;
	
	class Model extends \jexm\core\BaseModel{
		
		
		public function __construct(){
			parent::__construct();
		}
		
		protected function tableExist($tablename){
			$sql = "SELECT * FROM information_schema.tables 
					WHERE TABLE_NAME = ? 
					AND TABLE_SCHEMA != 'mysql'";
			$result = $this->fetch($sql,[$tablename]);
			return (count($result) > 0) ? true : false;
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