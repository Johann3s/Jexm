<?php
	/**
	* Defining constant to determine root of url. 
	*/
	function resolveURLRoot($server){
		return ($server['SERVER_NAME'] == "localhost") ? "/".basename(dirname(__DIR__)) : "/";
	}
	$urlRoot = resolveURLRoot($_SERVER);
	
	define('URL_ROOT',$urlRoot);