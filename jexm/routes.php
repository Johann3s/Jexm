<?php
	//$route = \jexm\core\route\Routes::getInstance();
	
	/**
	*
	*
	* Here you define your routes.
	* You can define a route with just a controller or controller with a method.
	*
	*
	*/
	Routes::get('/','Test@idx');
	Routes::post('/', 'test@postData');
	Routes::get('/params/<name>','test@showParam');
	Routes::get('/params','test@doRockAndRoll');
	Routes::get('/test','test2@index');
	/*
	$route->set('/pagination','test@helloWorld');
	$route->set('/user','test@createUser');
	$route->set('/user/auth','test@authUser');
	$route->set('/user/logout','test@logoutUser');*/

