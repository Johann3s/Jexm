<?php
	$routes = \jexm\core\Routes::getRoutesObject();
	
	/**
	* Here you define your routes if any.
	* You can define a route with just a controller or controller with a method.
	*/
	
	$routes->set('/merch','merch@index');
	$routes->set('/','test@helloWorld');
	//var_dump($_SERVER);
