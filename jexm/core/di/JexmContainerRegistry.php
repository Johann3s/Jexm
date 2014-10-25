<?php
	namespace jexm\core\di;
	
	class JexmContainerRegistry{
		
		
		public function registerObjects(\jexm\core\di\JexmContainer $container){
			
			$container->register("Router",function(){
				return new \jexm\core\Router(\jexm\core\route\Routes::getInstance());
			});
			
			$container->register("Dispatcher",function(){
				return new \jexm\core\Dispatcher(new \jexm\core\Router(\jexm\core\route\Routes::getInstance()), \jexm\core\route\Routes::getInstance());
			});
			
			$container->register("FolderCrawler",function(){
				return \jexm\core\FolderCrawler::getInstance();
			});

			$container->register("Log",function(){
				return new \jexm\core\LogWriter;
			});
			
			$container->register("Paginator",function(){
				return new \jexm\core\Paginator();
			});	
			
			$container->register("View",function(){
				return new \jexm\core\View(new \Twig_Loader_Filesystem(TEMPLATE_PATH));
			});
			$container->register("Di",function(){
				return new \jexm\core\di\JexmDi();
			});			

			
			/**
			* ----> Routes <----
			*/
			$container->register("CurrentRequest",function(){
				return new \jexm\core\route\CurrentRequest();
			});	
			
			$container->register("Routes",function(){
				return \jexm\core\route\Routes::getInstance();
			});	
			
			$container->register("Route",function(){
				return new \jexm\core\route\Route();
			});		
			
			$container->register("RouteMatcher",function(){
				return new \jexm\core\route\RouteMatcher(\jexm\core\route\Routes::getInstance());
			});		
			
			/**
			* ----> Helpers <----
			*/	
			$container->register("Authenticate",function(){
				return new \jexm\core\helpers\JexmAuthentication(new \jexm\core\models\User());
			});		
			
			$container->register("Hasher",function(){
				return new \jexm\core\helpers\JexmHasher();
			});			
			
			$container->register("Sanitizer",function(){
				return new \jexm\core\helpers\JexmSanitizer();
			});		
			
			$container->register("Redirect",function(){
				return new \jexm\core\helpers\JexmRedirect(
					new \jexm\core\helpers\JexmLink(
							\jexm\core\route\Routes::getInstance()
						)
					);
			});		
			$container->register("Globals",function(){
				return new \jexm\core\helpers\JexmGlobals;
			});			
			$container->register("Link",function(){
				return new \jexm\core\helpers\JexmLink(\jexm\core\route\Routes::getInstance());
			});				
		}
	}