<?php
	
	/**
	* Here you need to define your timezone and URL root.
	* If you are using a virtual host no need to alter the URL_ROOT.
	* If not you need to switch comments.
	* DO NOT forget to set production to true if going live.
	*/
	
	
	
	
	/**
	* ------------ IMPORTANT -------------
	* Change constant to true if in production
	*/
	define('PRODUCTION',false);
	
	
	
	/**
	* Sets locale timezone.
	*/
	date_default_timezone_set('Europe/Stockholm');
	
	
	
	/**
	* Defining constants for routing and clientside scripts. 
	* Switch comments if urlroot is NOT '/' (no virtual host i.e localhost/jexm/)
	*/
	define('URL_ROOT',"/");
	//define('URL_ROOT',"/".basename(dirname(__DIR__))."/");
	
	


	
	

	
