<?php
	
	/**
	* This acts as bootstrap and configuration script.
	*
	* Here you need to define your database credentials and your timezone.
	*/
	
	
	/**
	* Sets locale timezone.
	*/
	date_default_timezone_set('Europe/Stockholm');
	
	
	/**
	* Define name of default HomeController. (home,start,index etc)
	* Can be overriden by setting a route to ("/" in jexm/routes.php)
	*/
	define('HOME',"StartController");
	
	
	
	/**
	* Defining constants for routing and clientside scripts. 
	* Switch comments if urlroot is NOT '/' (no virtual host i.e localhost/jexm/)
	*/
	define('URL_ROOT',"/");
	//define('URL_ROOT',"/".basename(dirname(__DIR__))."/");

	
	
	/**#@+
	* Define database credentials, change to your own.
	*/
	define('DSN',"mysql:host=localhost;dbname=jexm;charset=utf8;");
	define('USERNAME',"username");
	define('PASSWORD',"password");
	

	
	

	
