<?php
	/**
	* Defining constant to determine root of url. 
	*/
	function resolveURLRoot($server){
		return ($server == "localhost") ? "/".basename(dirname(__DIR__)) : "/";
	}
	$urlRoot = resolveURLRoot($_SERVER['SERVER_NAME']);
	
	define('URL_ROOT',$urlRoot);
	
	/*function jexmExceptions($exception) {
		\jexm\core\BaseHelper::kill($exception->getMessage());
	}

	set_exception_handler('jexmExceptions');	*/
	
