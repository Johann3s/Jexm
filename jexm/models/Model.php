<?php
	namespace jexm\models;
	
	class Model extends \jexm\core\BaseModel{
		
		protected $paginator;
		
		public function __construct(){
			parent::__construct();
		}
		
		
		public function getAll(){
			$resultset = $this->fetch("SELECT * FROM article_table WHERE articleid < ? ORDER BY title ASC",[50],10);
			return $resultset;
		}
		
	}