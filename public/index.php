<?php
	/**
	* You are using Jexm Framework.
	*
	* @version 1.0
	* @author Johannes
	*/
	
	
	/**
	* Shortcut for MAGIC_CONSTANT ( / || \ ).
	*/
	define('DS',DIRECTORY_SEPARATOR);
	
	
	
	/**#@+
	* Defining constants with path to applicationfolders directly.
	*/
	define('ROOT',dirname(__DIR__) . DS);
	define('JEXM_PATH',ROOT."jexm".DS);
	define('TEMPLATE_PATH',JEXM_PATH."views".DS);
	define('LOG_PATH',ROOT."logs".DS);
	
	

	/**
	* Include autoloader and settings.
	*/
	require_once(JEXM_PATH.DS."core".DS."FolderCrawler.php");
	require_once(JEXM_PATH.DS."core".DS."Autoloader.php");
	$je = jexm\core\FolderCrawler::getFolderCrawler()->browseDirectory();
	$xm = new jexm\core\Autoloader();

	
	
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
	$jexm = new jexm\core\Jexm();
	$jexm->launch();
	
?>