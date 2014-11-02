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
					  ->where('articleid','<',5)
					  ->orderBy('articleid','ASC')
					  //->paginate(5)
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
		
		public function joinstuff(){
				$result = DB::table('books')
					  ->select('title','author','name','income')
					  ->join('publishers',['publisher_id','=','publishers.id'])
					  ->join('revenue',['book_id','=','books.id'])
					  ->where('author','LIKE','Tolk%')
					  ->orWhere('income','>','8000')
					  ->orderBy('books.id','DESC')
					  ->get();
			return $result;	
		}
	}