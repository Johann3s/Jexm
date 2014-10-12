<?php
	$route = \jexm\core\route\Routes::getRoutesObject();
	
	/**
	*
	*
	* Here you define your routes.
	* You can define a route with just a controller or controller with a method.
	*
	*
	*/
	$route->get('/','test@idx');
	$route->post('/', 'test@postData');
	$route->get('/params/<name>','test@showParam');
	/*$route->set('/test','test2@index');
	$route->set('/pagination','test@helloWorld');
	$route->set('/user','test@createUser');
	$route->set('/user/auth','test@authUser');
	$route->set('/user/logout','test@logoutUser');*/

