<?php
	namespace jexm\core;
	
	use \jexm\core\facades\URL as URL;
	use \jexm\core\facades\Link as Link;
	
	class Paginator{
		
		/**
		* @var int Holds current page
		*/
		protected $currentPage = 1;
		
		/**
		* @var int Holds number of posts/items per page
		*/		
		protected $perPage = 3;
		
		/**
		* @var int Holds total number of posts/items
		*/				
		protected $totalCount;
		
		

		
		/**
		* SETTERS
		*/
		
		
		/**
		* Sets limit
		*/
		public function setPerPage($perPage){ 
			$this->perPage = $perPage;
			return $this;
		}
		
		
		/**
		* Sets total count
		*/
		public function setTotalCount($totCount){ 
			$this->totalCount = $totCount;
			return $this;
		}
		
		
		/**
		* Sets the current page (determined via getstring in pagination links)
		*/
		public function setCurrentPage($currentPage){
			$this->currentPage = $currentPage;
			return $this;
		}
		
		
		/**
		* GETTERS
		*/
		
		
		/**
		* Calculate num of total pages to display
		*/
		protected function totalPages(){
			return ceil($this->totalCount/$this->perPage); 
		}
		
		
		/**
		* Calc prev page
		*/
		protected function previousPage(){
			return $this->currentPage - 1;
		}
		
		
		/**
		* calc next page
		*/
		protected function nextPage(){
			return $this->currentPage + 1;
		}
		

		
		/**
		* Cacl offset for SQL-query
		*/
		public function getOffset(){
			return ($this->currentPage - 1) * $this->perPage;
		}
		
		
		/**
		* Calc limit for SQL-query
		*/
		public function getLimit(){
			return $this->perPage;
		}
		
		
		/**
		* Get links for display
		*/
		public function getLinks(){
			$url = URL::getCurrentURLWithoutQueryString();
			
			$links = "<p class='pagination-links'>";
			if($this->totalPages() <= 1){ //Finns det inga fler sidor finns inga länkar att hämta.
				return;
			}
			if($this->previousPage() > 0){
				$links .= Link::paginate($url,"<<", ["page" => $this->previousPage()]);
			}
			for($i = 1; $i<$this->totalPages() + 1;$i++){
				if($i == $this->currentPage){ //Är det aktuell sida. Visa ingen länk.
					$links .= "<b class='current'>" . $i . "</b>";
				}else{
					$links .= Link::paginate($url,$i,["page" => $i]);
				}
			}
			if($this->nextPage() <= $this->totalPages()){
				$links .= Link::paginate($url,">>",["page" => $this->nextPage()]);;
			}
			$links .= "</p>";
			return $links;
		}
	}
?>