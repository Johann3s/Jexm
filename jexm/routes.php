<?php
	$routes = \jexm\core\Routes::getRoutesObject();
	
	/**
	*
	*
	* Here you define your routes.
	* You can define a route with just a controller or controller with a method.
	*
	*
	*/
	
	$routes->set('/merch','merch@index');
	$routes->set('/pagination','test@helloWorld');
	$routes->set('/user','test@createUser');
