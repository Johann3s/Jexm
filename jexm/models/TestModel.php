<?php
	namespace jexm\models;
	
	class TestModel extends Model{
		
		protected $table = "article_table";
	
		public function __construct(){
			parent::__construct();
			class_alias('jexm\core\facades\DB','jexm\models\DB');
		}
		
		public function getArticle(){//
			$result = DB::table($this->table)
					  ->select('articleid','title')
					  ->where('articleid','<',9)
					 // ->orWhere('articleid','=',8)
					  ->orderBy('articleid','ASC')
					  ->getCount();
			return $result;
		}
		
		public function getCount(){
			$result = DB::table($this->table)
					  ->select('articleid','title')
					  ->where('articleid','<',9)
					  ->orWhere('articleid','=',8)
					  ->orderBy('articleid','ASC')
					  ->getCount();
			return $result;		
		}
	}