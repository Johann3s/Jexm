<?php
	namespace jexm\core;
	
	use \jexm\core\helpers\JexmLink as Link;
	use \jexm\core\helpers\JexmURL as URL;
	
	class Paginator{
		
		protected $currentPage = 1;
		protected $perPage = 3;
		protected $totalCount;
		
		protected $link;

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
		
		protected function totalPages(){
			return ceil($this->totalCount/$this->perPage); 
		}
		protected function previousPage(){
			return $this->currentPage - 1;
		}
		protected function nextPage(){
			return $this->currentPage + 1;
		}
		
		/**
		* GETTERS
		*/
		public function getOffset(){
			return ($this->currentPage - 1) * $this->perPage;
		}
		public function getLimit(){
			return $this->perPage;
		}
		public function getLinks(){
			$this->link = jexm\core\helpers\JexmLink();
			$url = URL::getCurrentURLWithoutQueryString();
			$links = "<p class='pagination-links'>";
			if($this->totalPages() <= 1){ //Finns det inga fler sidor finns inga länkar att hämta.
				return;
			}
			if($this->previousPage() > 0){
				$links .= $link->paginate($url,"<<", ["page" => $this->previousPage()]);
			}
			for($i = 1; $i<$this->totalPages() + 1;$i++){
				if($i == $this->currentPage){ //Är det aktuell sida. Visa ingen länk.
					$links .= "<b class='current'>" . $i . "</b>";
				}else{
					$links .= $link->paginate($url,$i,["page" => $i]);
				}
			}
			if($this->nextPage() <= $this->totalPages()){
				$links .= $link->paginate($url,">>",["page" => $this->nextPage()]);;
			}
			$links .= "</p>";
			return $links;
		}
	}
?>