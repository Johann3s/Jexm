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
	
	
	/**
	* Eases internal calls to files and directories, sets ROOT to projects rootdirectory.
	*/
	define('ROOT',dirname(__DIR__) . DS);
	

	
	/**
	* Includes bootstrap and configs
	*/
	require_once(ROOT."config".DS."config.php");
	require_once(JEXM_PATH."routes.php");
	
	$jexm = new jexm\core\Jexm();
	$jexm->launch();
	
?>