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
	* Define name of first page (home,start etc)
	*/
	define('HOME',"start");
	
	
	/**
	* Defining constants for routing and clientside scripts. 
	* Switch comments if urlroot is NOT '/' (no virtual host i.e localhost/jexm/)
	*/
	define('URL_ROOT',"/");
	//define('URL_ROOT',"/".basename(dirname(__DIR__))."/");

	
	
	/**#@+
	* Defining constants with path to appfolders directly.
	* 
	*/
	define('JEXM_PATH',ROOT."jexm".DS);
	define('TEMPLATE_PATH',JEXM_PATH."views".DS);
	define('LOG_PATH',ROOT."logs".DS);
	
	
	/**#@+
	* Define database credentials, change to your own.
	*/
	define('DSN',"mysql:host=localhost;dbname=jexm;charset=utf8;");
	define('USERNAME',"username");
	define('PASSWORD',"password");
	
	
	/**
	* Include autoloader and settings.
	*/
	require_once(JEXM_PATH.DS."core".DS."Autoloader.php");
	$autoLoader = new jexm\core\Autoloader();
	
	
	/**
	* Start session.
	*/
	session_name(preg_replace('/[^a-z\d]/i', '', __DIR__));
	session_start();
	
	

	
