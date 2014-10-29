<?php
	namespace jexm\models;
	
	class TestModel extends Model{
		
		protected $table = "article_table";
	
		public function __construct(){
			parent::__construct();
		}
		
		public function getstuff(){//
			$result = DB::table($this->table)
					  ->select()
					  //->where('title','=',"Imma title")
					  //->where('active','=',85)
					  ->where('articleid','<',22)
					  ->orderBy('articleid','ASC')
					  ->paginate(5)
					  ->get();
			return $result;
		}
		
		public function updatestuff(){
			$result = DB::table($this->table)
					  ->change('text',"Detta är nyaste text")
					  ->change('title',"Detta är nyaste title")
					  ->where('articleid','=',9)
					  ->execute();
			return $result;		
		}
		
		public function deletestuff(){
			$result = DB::table($this->table)
					  ->remove()
					  ->where('articleid','=',10)
					  ->limit()
					  ->execute();
			return $result;		
		}		
		
		public function addstuff(){
			$result = DB::table($this->table)
					  ->add('text',"Jag är lite brödtext")
					  ->add('title',"Imma title 2")
					  ->add('active',89)
					  ->execute();
			return $result;		
		}	
	}