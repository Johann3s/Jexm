<?php
	/**
	* You are using Jexm Framework.
	*
	* @version 1.0
	* @author Johannes
	*/
	
	
	/**
	* Shortcut for directory separator.
	*/
	define('DS',DIRECTORY_SEPARATOR);
	
	
	/**#@+
	* Defining constants with path to applicationfolders directly.
	*/
	define('ROOT',dirname(__DIR__) . DS);
	define('JEXM_PATH',ROOT."jexm".DS);
	define('TEMPLATE_PATH',JEXM_PATH."views".DS);
	define('PUBLIC_PATH',ROOT."public".DS);
	define('LOG_PATH',ROOT."logs".DS);
	
	
	

	/**
	* Include autoloader and settings.
	*/

	require_once(JEXM_PATH.DS."core".DS."Autoloader.php");
	new jexm\core\Autoloader();	
	$container = \jexm\core\di\JexmContainer::getInstance(new \jexm\core\di\JexmDi());
	(new \jexm\core\facades\alias\Aliases())->setGlobal();
	
	
	
	
	/**
	* Include composers vendor autoload
	*/
	require_once(ROOT."vendor".DS."autoload.php");
	Twig_Autoloader::register();
	
	
	/**
	* Include configs
	*/
	require_once(ROOT."config".DS."config.php");
	
	
	/**
	* Turn off errors if in production
	*/
	if(!PRODUCTION){
		error_reporting(E_ALL);

		//Set errorhandling
		$run     = new Whoops\Run;
		$handler = new Whoops\Handler\PrettyPageHandler();
		$handler->setPageTitle("You Baad!!");
		$run->pushHandler($handler);
		$run->register();			
	}else{
		error_reporting(0);
	}

	
	
	
	/**
	* Include configs and userdefined routes
	*/
	require_once(ROOT."config".DS."root.php");
	require_once(JEXM_PATH."routes.php");	
	
	
	
	
	/**
	* Start session.
	*/
	session_name(preg_replace('/[^a-z\d]/i', '', __DIR__));
	session_start();
	
	
	/**
	* Launch application
	*/
	(new jexm\core\Jexm())->launch();
	
?>