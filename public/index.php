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
	define('LOG_PATH',ROOT."logs".DS);
	
	//error_reporting(E_ALL);

	/**
	* Include autoloader and settings.
	*/
	require_once(JEXM_PATH.DS."core".DS."FolderCrawler.php");
	require_once(JEXM_PATH.DS."core".DS."Autoloader.php");
	

	$validFiles = jexm\core\FolderCrawler::getInstance()
				  ->browseDirectory()
				  ->getValidFilesToRequire();
				  
	(new jexm\core\Autoloader())->setDirectories($validFiles);
	
	
	
	/**
	* Include composers vendor autoload
	*/
	require_once(ROOT."vendor".DS."autoload.php");
	
	Twig_Autoloader::register();

	//Routes::get('fdsa','asdda');
	//die();
	/**
	* Include configs and userdefined routes
	*/
	require_once(ROOT."config".DS."config.php");
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
	//class_alias('\jexm\core\facades\Router','\Router');
	
	//$registryContainer = (new \jexm\core\di\JexmContainerRegistry())->doRegisterObjects();
	//Router::say("Johannes");

	(new jexm\core\Jexm())->launch();
	
?>