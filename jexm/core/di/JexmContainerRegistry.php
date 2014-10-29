<?php
	namespace jexm\core\di;
	
	class JexmContainerRegistry{
		
		
		public function registerObjects(\jexm\core\di\JexmContainer $container){
			
			$container->register("Router",function() use ($container){
				$routes = $container->getFromContainer("Routes");
				return new \jexm\core\Router($routes);
			});
			
			$container->register("Dispatcher",function() use ($container){
				$routes = $container->getFromContainer("Routes");
				$router = $container->getFromContainer("Router");
				return new \jexm\core\Dispatcher($router,$routes);
			});
			
			$container->register("FolderCrawler",function(){
				return new \jexm\core\FolderCrawler();
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
			
			$container->register("RouteMatcher",function() use ($container){
				$routes = $container->getFromContainer("Routes");
				return new \jexm\core\route\RouteMatcher($routes);
			});		
			
			/**
			* ----> Helpers <----
			*/	
			$container->register("Authenticate",function() use ($container){
				$user = $container->getFromContainer("User");
				return new \jexm\core\helpers\JexmAuthentication($user);
			});		
			
			$container->register("Hasher",function(){
				return new \jexm\core\helpers\JexmHasher();
			});			
			
			$container->register("Sanitizer",function(){
				return new \jexm\core\helpers\JexmSanitizer();
			});		
			
			$container->register("Redirect",function() use ($container){
				$link = $container->getFromContainer("Link");
				return new \jexm\core\helpers\JexmRedirect($link);
			});		
			
			$container->register("Globals",function(){
				return new \jexm\core\helpers\JexmGlobals;
			});		
			
			$container->register("Link",function() use ($container){
				$routes = $container->getFromContainer("Routes");
				return new \jexm\core\helpers\JexmLink($routes);
			});	
				
			/**
			* ----> Models <-----
			*/
			$container->register("User",function(){
				return new \jexm\models\User();
			});					
		}
	}