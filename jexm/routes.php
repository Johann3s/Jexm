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
	
	$routes->set('/test','test2@index');
	$routes->set('/pagination','test@helloWorld');
	$routes->set('/user','test@createUser');
	$routes->set('/user/auth','test@authUser');
	$routes->set('/user/logout','test@logoutUser');

